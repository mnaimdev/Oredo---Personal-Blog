<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestMailVerify;
use App\Notifications\GuestMailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Hash;

class GuestRegisterController extends Controller
{
    function guest_register()
    {
        return view('frontend.guest_register');
    }

    // function guest_register_store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     GuestLogin::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'created_at' => Carbon::now(),
    //     ]);

    //     if (Auth::guard('guestlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         return redirect()->route('welcome')->with('login_success', 'Login Successfully');
    //     }
    // }

    function guest_register_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $guest_reg_info = GuestLogin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        $guest_info_inserted = GuestMailVerify::create([
            'guest_id' => $guest_reg_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::sendNow($guest_reg_info, new GuestMailVerifyNotification($guest_info_inserted));

        return redirect()->route('guest.register')->with('guest_register', 'We have sent you a notification to verify your email🙂');

        // if (Auth::guard('guestlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect()->route('welcome')->with('login_success', 'Login Successfully!');
        // }
    }

    function guest_login()
    {
        return view('frontend.guest_login');
    }

    function guest_login_request(Request $request)
    {
        if (Auth::guard('guestlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('guestlogin')->user()->email_verified_at == null) {
                Auth::guard('guestlogin')->logout();
                return redirect()->route('mail.verify.req')->with([
                    'verify_req' => 'Please verify your email',
                    'mail' => $request->email,
                ]);
            } else {
                return redirect()->route('welcome')->with('login_success', 'Successfully Logged in');
            }
        } else {
            return redirect()->route('guest.login')->with('login', 'Email or Password Does Not Match!');
        }
    }


    function guest_logout()
    {
        Auth::guard('guestlogin')->logout();
        return redirect()->route('guest.login');
    }

    function guest_profile()
    {

        return view('frontend.guest_profile');
    }

    function guest_profile_update(Request $request)
    {
        if ($request->new_password == "") {
            GuestLogin::find(Auth::guard('guestlogin')->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return back();
        } else {
            if (Hash::check($request->old_password, Auth::guard('guestlogin')->user()->password)) {
                GuestLogin::find(Auth::guard('guestlogin')->user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->new_password),
                ]);

                return back();
            } else {
                return back()->with('old', 'Old Password Not Match!');
            }
        }
    }

    function verify_mail_confirm($token)
    {
        $guest = GuestMailVerify::where('token', $token)->firstOrFail();

        GuestLogin::findOrFail($guest->guest_id)->update([
            'email_verified_at' => Carbon::now(),
        ]);
        $guest->delete();

        return redirect()->route('guest.login')->with('verify_mail_confirm', 'Congratulations! You have verified your mail:)');
    }

    function mail_verify_req()
    {
        //
        // If user logged in
        if (Auth::guard('guestlogin')->user()) {
            if (Auth::guard('guestlogin')->user()->email_verified_at == null) {
                return view('mail.mail_verify_req');
            } else {
                return redirect()->route('welcome')->with('login_success', 'Successfully Logged in');
            }
        } else {
            return view('mail.mail_verify_req');
        }
    }

    function mail_verify_again(Request $request)
    {
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();

        GuestMailVerify::where('guest_id', $guest_info->id)->delete();

        $guest_info_inserted = GuestMailVerify::create([
            'guest_id' => $guest_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::sendNow($guest_info, new GuestMailVerifyNotification($guest_info_inserted));
        return redirect()->route('mail.verify.req')->with('mail_again', 'We have sent you a notification to verify your mail');
    }
}
