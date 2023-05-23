<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    function product_variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view("backend.product.product_variation", [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    function color_store(Request $request)
    {
        $request->validate([
            'color_name' => 'required',
        ]);

        Color::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);

        return back()->with("color", "Color Added :)");
    }

    function size_store(Request $request)
    {
        $request->validate([
            'size_name' => 'required',
        ]);

        Size::create([
            'size_name' => $request->size_name,
        ]);

        return back()->with("size", "Size Added :)");
    }

    function color_delete($color_id)
    {
        Color::find($color_id)->delete();

        return back()->with("color_delete", "Deleted Successfully :) ");
    }

    function size_delete($size_id)
    {
        Size::find($size_id)->delete();

        return back()->with("size_delete", "Deleted Successfully :) ");
    }
}
