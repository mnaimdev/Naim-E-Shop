<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\StripeOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe;
use Str;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        $data = session('data');
        $phone =  $data['phone'];

        $total = $data['sub_total'] + $data['charge'] - $data['discount'];

        $stripe_id = StripeOrder::insertGetId([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'phone'             => $phone,
            'address'           => $data['address'],
            'company'           => $data['company'],
            'country_id'        => $data['country_id'],
            'city_id'           => $data['city_id'],
            'zip_code'          => $data['zip_code'],
            'notes'             => $data['notes'],
            'payment_method'    => $data['payment_method'],
            'sub_total'         => $data['sub_total'],
            'charge'            => $data['charge'],
            'discount'          => $data['discount'],
            'total'             => $total,
            'customer_id'       => $data['customer_id'],
            'created_at'        => Carbon::now(),
        ]);

        return view('stripe', [
            'data'          => $data,
            'stripe_id'     => $stripe_id,
            'total'         => $total,
        ]);
    }


    public function stripePost(Request $request)
    {

        $data =  StripeOrder::find($request->stripe_id);
        $total = $data->sub_total + $data->charge - $data->discount;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');


        $order_id = '#mnaimdev-' . Str::upper(Str::random(3)) . rand(111111, 999999999);
        $total = $request->sub_total - $request->discount + $request->charge;

        BillingDetail::create([
            'order_id'              => $order_id,
            'customer_id'           => $data->customer_id,
            'name'                  => $data->name,
            'email'                 => $data->email,
            'address'               => $data->address,
            'phone'                 => $data->phone,
            'company'               => $data->company,
            'zip_code'              => $data->zip_code,
            'country_id'            => $data->country_id,
            'city_id'               => $data->city_id,
            'notes'                 => $data->notes,
            'created_at'            => Carbon::now(),

        ]);


        Order::create([
            'order_id'              => $order_id,
            'customer_id'           => $data->customer_id,
            'payment_method'        => $data->payment_method,
            'sub_total'             => $data->sub_total,
            'discount'              => $data->discount,
            'charge'                => $data->charge,
            'total'                 => $total,
            'created_at'            => Carbon::now(),
        ]);

        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id'          => $order_id,
                'customer_id'       => $data->customer_id,
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
        Mail::to($data->email)->send(new InvoiceMail($order_id));

        Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();


        return redirect()->route('order.complete')->with('order', $order_id);
    }
}
