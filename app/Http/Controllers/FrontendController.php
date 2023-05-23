<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

class FrontendController extends Controller
{
    function index()
    {

        $categories = Category::all();
        $products = Product::all();
        $new_items = Product::latest('created_at')->take(6)->get();

        $top_orders = OrderProduct::groupBy('product_id')
            ->selectRaw('product_id, sum(quantity) as sum')
            ->havingRaw('sum >= 1')
            ->orderBy('sum', 'DESC')
            ->get();



        $top_ratings = OrderProduct::groupBy('product_id')
            ->selectRaw('product_id, sum(star) as sum')
            ->havingRaw('sum >= 1')
            ->orderBy('sum', 'DESC')
            ->get();


        $top_discounts = Product::groupBy('id')
            ->selectRaw('id, sum(discount) as sum')
            ->havingRaw('sum >= 5')
            ->orderBy('sum', 'DESC')
            ->get();



        return view('frontend.index', [
            'categories'            => $categories,
            'products'              => $products,
            'top_orders'            => $top_orders,
            'new_items'             => $new_items,
            'top_ratings'           => $top_ratings,
            'top_discounts'         => $top_discounts,
        ]);
    }

    function product_details($slug)
    {
        $products = Product::where('slug', $slug)->first();
        $related_products = Product::where('category_id', $products->category_id)->where('id', '!=', $products->id)->get();

        $available_colors = Color::all();
        $sizes = Size::all();

        $reviews = OrderProduct::where('product_id', $products->id)->where('review', '!=', null)->get();
        $total_reviews = OrderProduct::where('product_id', $products->id)->where('review', '!=', null)->count();
        $ratings = OrderProduct::where('product_id', $products->id)->where('review', '!=', null)->sum('star');


        return view('frontend.product.product_details', [
            'products'                     => $products,
            'related_products'             => $related_products,
            'available_colors'             => $available_colors,
            'sizes'                        => $sizes,
            'reviews'                      => $reviews,
            'total_reviews'                => $total_reviews,
            'ratings'                      => $ratings,
        ]);
    }


    function getSize(Request $request)
    {
        $sizes = Inventory::where("product_id", $request->product_id)->where("color_id", $request->color_id)->get();

        $str = '';
        foreach ($sizes as $size) {

            $str .= '
            <div class="form-check size-option form-option  form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="size_id"
                    value="' . $size->size_id . '"
                        id="' . $size->size_id . '">
                    <label class="form-option-label"
                        for="' . $size->size_id . '">' . $size->rel_to_size->size_name . ' </label>
            </div>';
        }
        echo $str;
    }


    function review_store(Request $request)
    {
        if ($request->image == '') {
            OrderProduct::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review'        => $request->review,
                'star'          => $request->star,
            ]);
            return back();
        } else {

            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  $request->customer_id . "." . $extension;

            Image::make($uploaded_file)->save(public_path('/uploads/review/' . $file_name));

            OrderProduct::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review'        => $request->review,
                'star'          => $request->star,
                'image'         => $file_name,
            ]);

            return back();
        }
    }
}
