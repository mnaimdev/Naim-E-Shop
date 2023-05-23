<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    function google_callback()
    {
        $user = Socialite::driver('google')->user();

        if (CustomerLogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
                return redirect()->route('index')->with('login', 'Login Successfully');
            }
        } else {
            CustomerLogin::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('naim1234'),
            ]);

            if (Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(), 'password' => 'naim1234'])) {
                return redirect()->route('index')->with('login', 'Login Successfully');
            }
        }
    }
}
