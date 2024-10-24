<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('front.account.profile-setting', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email',
            'designation' => 'nullable|string',
            'mobile'      => 'nullable|string',
        ]);

        $user              = auth()->user();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->designation = $request->designation;
        $user->mobile      = $request->mobile;
        $user->save();

        session()->flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        // Check the old password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update the new password
        $user->password = bcrypt($request->new_password);
        $user->save();

        // Flash success message
        session()->flash('success', 'Password changed successfully.');

        return redirect()->route('profile'); // Redirect to the profile page or another page
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Allow only image files up to 2MB
        ]);

        $user = auth()->user();

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            // Store the new image
            $path = $request->file('image')->store('uploads', 'public');

            // Update user's image path in the database
            $user->image = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }
    public function deleteProfilePicture()
    {
        $user = auth()->user();

        // Kiểm tra xem người dùng có ảnh đại diện không
        if ($user->image) {
            // Xóa file ảnh từ storage
            Storage::disk('public')->delete($user->image);

            // Cập nhật trường ảnh đại diện của người dùng trong database
            $user->image = null;
            $user->save();

            // Trả về thông báo thành công
            return redirect()->back()->with('success', 'Profile picture deleted successfully.');
        }

        return redirect()->back()->with('error', 'No profile picture found.');
    }



}
