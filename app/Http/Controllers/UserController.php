<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Image;

class UserController extends Controller
{
    function edit_profile()
    {
        return view('backend.user.edit_profile');
    }

    function profile_update(Request $request)
    {

        if ($request->new_password == '') {
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return back()->with('profile', 'Profile updated successfully!');
        }

        // else
        else {

            $request->validate([
                'new_password' => RulesPassword::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ]);

            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->new_password),

                ]);

                return back()->with('profile', 'Profile updated successfully!');
            } else {
                return back()->with('match', 'Old password not match :)');
            }
        }
    }

    function profile_photo(Request $request)
    {

        $request->validate([
            'image' => 'required|image',
            'image' => 'mimes:png,jpg| file|max:5000',
        ]);

        if (Auth::user()->image == '') {
            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/user/' . $file_name));

            User::find(Auth::id())->update([
                'photo' => $file_name,
            ]);
            return back()->with('photo', 'Profile image updated successfully!');
        }

        // else
        else {
            $image = Auth::user()->image;
            $deleted_from = public_path('/uploads/user/' . $image);
            unlink($deleted_from);

            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/user/' . $file_name));

            User::find(Auth::id())->update([
                'photo' => $file_name,
            ]);
            return back()->with('photo', 'Profile image updated successfully!');
        }
    }

    function user()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('backend.user.user', [
            'users' => $users,
        ]);
    }

    function delete_user($user_id)
    {
        if (User::find($user_id)->photo == '') {
            User::find($user_id)->delete();
            return back()->with('delete', 'User deleted successfully!');
        }

        // else
        else {
            $image = User::find($user_id)->photo;
            $deleted_from = public_path('/uploads/user/' . $image);
            unlink($deleted_from);

            User::find($user_id)->delete();
            return back()->with('delete', 'User deleted successfully!');
        }
    }
}
