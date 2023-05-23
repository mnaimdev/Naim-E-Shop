<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\EmailVerify;
use App\Models\PassReset;
use App\Notifications\EmailVerifyNotification;
use App\Notifications\PassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{
    function customer_login()
    {
        return view('frontend.custom.custom_login');
    }

    function customer_register()
    {
        return view('frontend.custom.custom_registration');
    }

    function register_store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'email'      => 'required|unique:customer_logins,id',
            'password'   => 'required',
        ]);

        if ($request->password_confirmation == $request->password) {
            CustomerLogin::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'created_at'        => Carbon::now(),
            ]);

            $customer = CustomerLogin::where('email', $request->email)->first();

            $customer_info = EmailVerify::create([
                'customer_id'       => $customer->id,
                'token'             => uniqid(),
                'created_at'        => Carbon::now(),
            ]);

            Notification::send($customer, new EmailVerifyNotification($customer_info));
            return back()->with('notif', 'We have send you a notification to verify your email!');
        } else {
            return back()->withError('Password Not Match!');
        }
    }

    function login_store(Request $request)
    {

        $customer = CustomerLogin::where('email', $request->email)->first();

        if ($customer->email_verified_at == '') {
            return back()->with('verify_mail', 'Please Verify Your email');
        } else {
            if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/')->with('login', 'Login Successfully');
            }
        }

        // if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     if (Auth::guard('customerlogin')->user()->email_verified_at == '') {
        //         return back()->with('verify_mail', 'Please Verify Your email');
        //     } else {
        //         return redirect('/')->with('login', 'Login Successfully');
        //     }
        // }

        // else
        // else {
        //     return back()->with('match', 'Email or Password Not Match!');
        // }
    }


    function customer_logout()
    {
        Auth::guard('customerlogin')->logout();
        return redirect('/');
    }


    function pass_reset()
    {
        return view('frontend.pass_reset.forget_password');
    }

    function pass_reset_req(Request $request)
    {
        if (CustomerLogin::where('email', $request->email)->exists()) {
            $customer_info = CustomerLogin::where('email', $request->email)->first();

            $customer_id = $customer_info->id;

            PassReset::where('customer_id', $customer_id)->delete();

            $customer_data = PassReset::create([
                'customer_id'     => $customer_id,
                'token'           => uniqid(),
                'created_at'      => Carbon::now(),
            ]);

            Notification::send($customer_info, new PassResetNotification($customer_data));

            return back()->with('notif', 'We have sent you a notification to reset your password');
        }

        // else
        else {
            return back()->with('reg', 'Please register first! We can\'t find your email');
        }
    }

    function pass_reset_form($token)
    {
        return view('frontend.pass_reset.pass_reset_form', [
            'token'     => $token,
        ]);
    }

    function pass_reset_complete(Request $request)
    {
        $customer_id = PassReset::where('token', $request->token)->first()->customer_id;

        if ($request->password != $request->password_confirmation) {
            return back()->with('not_match', 'Password Not Match');
        } else {
            CustomerLogin::find($customer_id)->update([
                'password' => bcrypt($request->password),
            ]);

            PassReset::where('token', $request->token)->delete();

            return redirect()->route('customer.login')->with('reset', 'You have successfully reset your password. Now you can login with your new password');
        }
    }


    // Email Verify
    function email_verify($token)
    {
        $customer = EmailVerify::where('token', $token)->first();

        $customer_id = $customer->customer_id;

        CustomerLogin::find($customer_id)->update([
            'email_verified_at'     => Carbon::now(),
        ]);

        $customer->delete();

        return redirect()->route('customer.login')->with('verify', 'Successfully Verified Your Email');
    }
}
