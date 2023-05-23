<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\CustomerLogin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use Image;

class CustomerController extends Controller
{

    function customer_profile()
    {
        return view('frontend.custom.customer_profile');
    }

    function customer_profile_update(Request $request)
    {


        if ($request->photo == '') {
            Customerlogin::find(Auth::guard("customerlogin")->id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'country' => $request->country,
                'address' => $request->address,
            ]);
        }

        // photo not empty
        else {

            if (Auth::guard("customerlogin")->user()->photo != null) {
                $profile_img = Auth::guard("customerlogin")->user()->photo;
                $deleted_from = public_path('/uploads/customer/' . $profile_img);
                unlink($deleted_from);
            }

            $uploaded_file = $request->photo;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::guard("customerlogin")->id() . "." . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/customer/' . $file_name));

            CustomerLogin::find(Auth::guard("customerlogin")->id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'country' => $request->country,
                'address' => $request->address,
                'photo' => $file_name,
            ]);
        }

        return back();
    }


    function customer_order()
    {
        $orders = Order::where('customer_id', Auth::guard('customerlogin')->id())->get();

        return view('frontend.custom.customer_order', [
            'orders' => $orders,
        ]);
    }
}
