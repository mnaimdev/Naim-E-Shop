<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;

class ProductController extends Controller
{
    function product()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.product.product', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }


    function product_store(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'long_desp' => 'required',
            'preview' => 'required|file|mimes:jpg,png|max:5000',

        ]);

        $slug = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(999999, 10000000) . '-ayan';

        $after_discount = $request->price - ($request->price * $request->discount) / 100;


        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/product/preview/' . $file_name));

        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'discount' => $request->discount,
            'brand_id' => $request->brand_id,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'slug' => $slug,
            'preview' => $file_name,
            'after_discount' => $after_discount,
            'created_at' => Carbon::now(),
        ]);

        // Thumbnail process

        $thumbnails = $request->thumbnail;

        if ($request->thumbnail != null) {

            foreach ($thumbnails as $thumbnail) {
                $extension = $thumbnail->getClientOriginalExtension();
                $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . rand(99999999, 10000000) . '.' . $extension;
                Image::make($thumbnail)->save(public_path('/uploads/product/thumbnail/' . $file_name));

                echo $file_name;

                Thumbnail::create([
                    'product_id' => $product_id,
                    'thumbnails' => $file_name,
                ]);
            }
        }

        return back()->with('product', 'Product added successfully');
    }


    function product_list()
    {
        $products = Product::all();
        return view('backend.product.product_list', [
            'products' => $products,
        ]);
    }

    function product_delete($product_id)
    {
        $product_img = Product::find($product_id)->preview;
        $deleted_from = public_path('/uploads/product/preview/' . $product_img);
        unlink($deleted_from);

        $thumbnails = Thumbnail::where('product_id', $product_id)->get();

        foreach ($thumbnails as $thumb) {
            $thumb_img = $thumb->thumbnails;
            $deleted_from = public_path('/uploads/product/thumbnail/' . $thumb_img);
            unlink($deleted_from);
        }

        Thumbnail::where('product_id', $product_id)->delete();

        // Inventory
        $inventories = Inventory::where('product_id', $product_id)->get();
        foreach ($inventories as $inventory) {
            Inventory::find($inventory->id)->delete();
        }

        Product::find($product_id)->delete();

        return back()->with('product_delete', 'Product has been deleted');
    }

    function getSubcategory(Request $request)
    {
        $str = '<option>-- Select Subcategory--</option>';

        $subcategories = Subcategory::where('category_id', $request->category_id)->get();

        foreach ($subcategories as $subcategory) {
            $str  .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }

        echo $str;
    }


    // Product Inventory
    function product_inventory($product_id)
    {
        $product = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $product->id)->get();
        return view('backend.product.inventory', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }


    function inventory_store(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        // if product exists then increment
        if (Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
        }


        // else
        else {
            Inventory::create([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back();
    }


    function inventory_delete($inventory_id)
    {
        Inventory::find($inventory_id)->delete();
        return back();
    }

    function preorder(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->preorder = $request->preorder;
        $product->save();

        return response()->json(['success' => 'succesfully updated preorder field']);
    }
}
