<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;


use Illuminate\Http\Request;

class FacebookLoginController extends Controller
{
    function redirect_provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function provider_to_application()
    {
        $user = Socialite::driver('facebook')->user();
        echo $user->getName();
    }
}
