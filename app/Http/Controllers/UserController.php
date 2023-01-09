<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // User Section
    function users()
    {
        $total_user = User::count();
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('name', 'asc')->paginate(10);
        return view('admin/users/users', [
            'users' => $users,
            'total_user' => $total_user,
        ]);
    }

    function edit_profile()
    {
        return view('admin.users.edit_profile');
    }

    function update_profile(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|unique:users'
            ],
            [
                User::find(Auth::id())->update([
                    'name' => $request->name,
                ])
            ]
        );

        if ($request->new_password == '') {
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
            ]);
            return back()->with('success', 'Profile Updated Successfully!');
        } else {

            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'password' => bcrypt($request->new_password),
                    'email' => $request->email,
                    'bio' => $request->bio,
                ]);
                return back()->with('success', 'Profile Updated Successfully!');
            } else {
                return back()->withError('Old Password Not Match!');
            }
        }
    }

    function update_photo(Request $request)
    {
        if (Auth::user()->image == null) {
            $uploaded_file = $request->photo;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back()->with('success-img', 'Image Updated Successfully!');
        } else {
            $user_img = Auth::user()->image;
            $delete_from = public_path('/uploads/users/' . $user_img);
            unlink($delete_from);

            $uploaded_file = $request->photo;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back()->with('success-img', 'Image Updated Successfully!');
        }
    }

    function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back();
    }

    function delete_check(Request $request)
    {
        foreach ($request->check as $check_user) {
            User::find($check_user)->delete();
        }
        return back();
    }

    // Trash Section
    function trash()
    {
        $trashes = User::onlyTrashed()->get();
        $total_trash = User::onlyTrashed()->count();
        return view('admin.users.trash', [
            'trashes' => $trashes,
            'total_trash' => $total_trash,
        ]);
    }

    function trash_restore($user_id)
    {
        User::onlyTrashed()->find($user_id)->restore();
        return back();
    }

    function trash_delete($user_id)
    {
        $image = User::onlyTrashed()->find($user_id);
        if ($image->image != null) {
            $delete_from = public_path('/uploads/users/' . $image->image);
            unlink($delete_from);
        }
        User::onlyTrashed()->find($user_id)->forceDelete();
        return back();
    }


    // restore all checked and delete all checked
    function user_all(Request $request)
    {
        switch ($request->input('action')) {
            case 'restore':
                $request->validate(
                    [
                        'check' => 'required',
                    ],
                    [
                        'check.required' => 'There is no trash list',
                    ]
                );

                foreach ($request->check as $check_user) {
                    User::onlyTrashed()->find($check_user)->restore();
                }
                return back();
                break;
            case 'delete':
                $request->validate(
                    [
                        'check' => 'required',
                    ],
                    [
                        'check.required' => 'There is no trash list',
                    ]
                );

                foreach ($request->check as $check_user) {
                    User::onlyTrashed()->find($check_user)->forceDelete();
                }
                return back();
                break;
        }
    }
}
