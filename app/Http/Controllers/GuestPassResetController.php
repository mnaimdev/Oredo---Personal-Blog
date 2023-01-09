<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestPassReset;
use App\Notifications\GuestPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;


class GuestPassResetController extends Controller
{
    function guest_pass_reset_req()
    {
        return view('passreset.guest_pass_reset_req');
    }


    function guest_pass_reset_req_send(Request $request)
    {
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestPassReset::where('guest_id', $guest_info->id)->delete();

        $guest_info_inserted = GuestPassReset::create([
            'guest_id' => $guest_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::sendNow($guest_info, new GuestPassResetNotification($guest_info_inserted));

        return redirect()->route('guest.pass.reset.req')->with('notif_send', 'We have sent you a verification notification! Check it out ):');
    }

    function guest_pass_reset_req_form($token)
    {
        return view('passreset.guest_pass_reset_form', [
            'token' => $token,
        ]);
    }


    function guest_pass_reset(Request $request)
    {
        if ($request->new_password == $request->confirm_password) {
            $guest = GuestPassReset::where('token', $request->token)->firstOrFail();
            GuestLogin::findOrFail($guest->guest_id)->update([
                'password' => bcrypt($request->confirm_password),
            ]);

            $guest->delete();

            return redirect()->route('guest.login')->with('pass_reset_success', 'Password Reset Successfully
            !');
        } else {
            return redirect()->route('guest.pass.reset.req.form')->with('password_not_match', 'Password Not Match!');
        }
    }
}
