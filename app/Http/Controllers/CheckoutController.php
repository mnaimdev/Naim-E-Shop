<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;

class CheckoutController extends Controller
{
    function checkout()
    {
        $countries = Country::all();
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.checkout.checkout', [
            'countries'     => $countries,
            'carts'         => $carts,
        ]);
    }

    function get_city(Request $request)
    {
        $str = '<option>-- Select City --</option>';

        $cities = City::where('country_id', $request->country_id)->get();

        foreach ($cities as $city) {
            $str .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $str;
    }


    function checkout_store(Request $request)
    {

        // cash on delivery
        if ($request->payment_method == 1) {

            $order_id = '#mnaimdev-' . Str::upper(Str::random(3)) . rand(111111, 999999999);
            $total = $request->sub_total - $request->discount + $request->charge;

            BillingDetail::create([
                'order_id'              => $order_id,
                'customer_id'           => $request->customer_id,
                'name'                  => $request->name,
                'email'                 => $request->email,
                'address'               => $request->address,
                'phone'                 => $request->phone,
                'company'               => $request->company,
                'zip_code'              => $request->zip_code,
                'country_id'            => $request->country_id,
                'city_id'               => $request->city_id,
                'notes'                 => $request->notes,
                'created_at'            => Carbon::now(),

            ]);


            Order::create([
                'order_id'              => $order_id,
                'customer_id'           => $request->customer_id,
                'payment_method'        => $request->payment_method,
                'sub_total'             => $request->sub_total,
                'discount'              => $request->discount,
                'charge'                => $request->charge,
                'total'                 => $total,
                'created_at'            => Carbon::now(),
            ]);

            $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::create([
                    'order_id'          => $order_id,
                    'customer_id'       => $request->customer_id,
                    'product_id'        => $cart->product_id,
                    'color_id'          => $cart->color_id,
                    'size_id'           => $cart->size_id,
                    'quantity'          => $cart->quantity,
                    'price'             => $total,
                    'created_at'        => Carbon::now(),
                ]);

                Inventory::where("product_id", $cart->product_id)->where("size_id", $cart->size_id)->where("color_id", $cart->color_id)->decrement('quantity', $cart->quantity);
            }



            // sending invoice
            Mail::to($request->email)->send(new InvoiceMail($order_id));

            Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();


            return redirect()->route('order.complete')->with('order', $order_id);
        }


        // payment with sslcommerz
        else if ($request->payment_method == 2) {
            $data = $request->all();
            return redirect()->route('pay')->with('data', $data);
        }

        // payment with stripe
        else {
            $data = $request->all();
            return redirect()->route('stripe')->with('data', $data);
        }
    }


    function order_complete()
    {


        $order_id = session('order_id');

        if (session('order')) {
            return view('frontend.order_complete', [
                'order_id' => $order_id,
            ]);
        } else {
            return redirect('/');
        }
    }
}
