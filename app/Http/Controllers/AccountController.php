<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function register()
    {
        return view('front.account.registration');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'             => ['required'],
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->passes()) {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Flash thông báo thành công
            session()->flash('success', 'Registration successful');

            return redirect()->route('login'); // Chuyển hướng về trang chủ hoặc trang khác
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    public function login()
    {
        return view('front.account.login');
    }

    public function processLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users',
            'password' => 'required|min:5',
        ]);

        if ($validator->passes()) {
            $credentials = $request->only('email', 'password');

            if (auth()->attempt($credentials)) {
                // Authentication passed...
                return redirect()->route('home');
            } else {
                // Flash thông báo lỗi
                session()->flash('error', 'Invalid email or password');

                return redirect()->back();
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = auth()->user();

        // Xoá CV cũ nếu có
        if ($user->cv) {
            Storage::delete('public/' . $user->cv);
        }

        // Lưu CV mới
        $path = $request->file('cv')->store('cvs', 'public');
        $user->cv = $path;
        $user->save();

        return redirect()->back()->with('success', 'CV uploaded successfully.');
    }

    public function deleteCV()
    {
        $user = auth()->user();

        // Xoá CV hiện tại
        if ($user->cv) {
            Storage::delete('public/' . $user->cv);
            $user->cv = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'CV deleted successfully.');
    }



}
