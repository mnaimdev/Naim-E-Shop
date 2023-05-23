<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    function wishlist()
    {
        $wishlists = Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->get();

        return view('wishlist.wishlist', [
            'wishlists'   => $wishlists,
        ]);
    }

    function wishlist_remove($id)
    {
        Wishlist::find($id)->delete();
        return back();
    }
}
