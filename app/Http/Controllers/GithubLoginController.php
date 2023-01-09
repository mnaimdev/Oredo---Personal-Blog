<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GithubLoginController extends Controller
{
    function redirect_provider()
    {
        return Socialite::driver('github')->redirect();
    }

    function provider_to_application()
    {
        // $user = Socialite::driver('github')->user();

        // if (GuestLogin::where('email', $user->getEmail())->exists()) {
        //     if (Auth::guard('guestlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
        //         return redirect()->route('welcome')->with('login_success', 'Login Successfully');
        //     }
        // }

        // GuestLogin::create([
        //     'name' => $user->getName(),
        //     'email' => $user->getEmail(),
        //     'password' => bcrypt('naim1234'),
        //     'created_at' => Carbon::now(),
        // ]);

        // if (Auth::guard('guestlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
        //     return redirect()->route('welcome')->with('login_success', 'Login Successfully');
        // }

        $user = Socialite::driver('github')->user();

        if (GuestLogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard('guestlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
                return redirect()->route('welcome')->with('login_success', 'Login Successfully');
            }
        }

        GuestLogin::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt('naim1234'),
            'created_at' => Carbon::now(),
        ]);

        if (Auth::guard('guestlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
            return redirect()->route('welcome')->with('login_success', 'Login Successfully');
        }
    }
}
