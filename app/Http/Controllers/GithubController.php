<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GithubController extends Controller
{
    function github_redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    function github_callback()
    {
        $user = Socialite::driver('github')->user();

        if (CustomerLogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(), 'password' => 'user1234'])) {
                return redirect()->route('index')->with('login', 'Login Successfully');
            }
        }

        // else
        else {
            CustomerLogin::create([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'password'      => bcrypt('user1234'),
            ]);

            if (Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(), 'password' => 'user1234'])) {
                return redirect()->route('index')->with('login', 'Login Successfully');
            }
        }
    }
}
