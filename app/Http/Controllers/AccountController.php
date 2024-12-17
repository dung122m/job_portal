<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\AccountVerificationMail;
use Illuminate\Support\Facades\Mail;
class AccountController extends Controller
{
    public function register()
    {
        return view('front.account.registration');
    }


    public function verify($id, $hash)
    {

        $user = User::findOrFail($id);

        if (sha1($user->email) === $hash && is_null($user->email_verified_at)) {
            $user->email_verified_at = now();
            $user->save();

            session()->flash('success', 'Account verified successfully. You can now log in.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'Invalid verification link or account already verified.');
            return redirect()->route('login');
        }
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'             => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->passes()) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Gửi email xác nhận
            $user->sendEmailVerificationNotification();


            session()->flash('success', 'Registration successful. Please check your email to verify your account.');

            return redirect()->route('login');
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
                // Kiểm tra nếu tài khoản chưa xác nhận email
                if (auth()->user()->email_verified_at === null) {
                    auth()->logout();
                    session()->flash('error', 'Your account is not verified. Please check your email for verification link.');
                    return redirect()->back();
                }

                return redirect()->route('home');
            } else {
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
