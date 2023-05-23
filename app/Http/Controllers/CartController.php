<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    function cart_store(Request $request)
    {
        if (Auth::guard('customerlogin')->check()) {

            if ($request->btn == 1) {
                $quantity = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;

                if ($request->quantity > $quantity) {
                    return back()->with('stock', 'total stock: ' . $quantity);
                } else {
                    Cart::create([
                        'customer_id'     => Auth::guard('customerlogin')->id(),
                        'product_id'      => $request->product_id,
                        'color_id'        => $request->color_id,
                        'size_id'         => $request->size_id,
                        'quantity'        => $request->quantity,
                        'created_at'      => Carbon::now(),
                    ]);

                    return back()->with('cart', 'Cart Added');
                }
            }


            // else
            else {
                Wishlist::create([
                    'customer_id'     => Auth::guard('customerlogin')->id(),
                    'product_id'      => $request->product_id,
                    'color_id'        => $request->color_id,
                    'size_id'         => $request->size_id,
                    'quantity'        => $request->quantity,
                    'created_at'      => Carbon::now(),
                ]);

                return back();
            }
        }
    }


    function cart(Request $request)
    {
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

        $discount = 0;
        $type = '';
        $message = '';


        if (Coupon::where('coupon_code', $request->coupon_code)->exists()) {
            if (Coupon::where('coupon_code', $request->coupon_code)->first()->validity > Carbon::now()->format('Y-m-d')) {
                $message = 'Coupon Code Applied';
                $discount = Coupon::where('coupon_code', $request->coupon_code)->first()->discount_amount;
                $type = Coupon::where('coupon_code', $request->coupon_code)->first()->type;
            } else {
                $message = 'Coupon Code Expired';
                $discount = 0;
            }
        } else {
            $message = 'Invalid Coupon';
            $discount = 0;
        }

        return view('frontend.cart.cart', [
            'carts'         => $carts,
            'discount'      => $discount,
            'message'       => $message,
            'type'          => $type,

        ]);
    }

    function cart_update(Request $request)
    {
        foreach ($request->quantity as $size_id => $quantity) {
            Cart::find($size_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back()->with("cart_update", "Cart Updated!");
    }


    function clear_cart_item($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }

    function clear_cart()
    {
        Cart::where('customer_id', Auth::guard('customerlogin')->id())->delete();
        return back();
    }
}
