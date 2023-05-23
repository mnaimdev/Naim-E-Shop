<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Str;

class BrandController extends Controller
{
    function brand()
    {
        $brands = Brand::all();
        return view('backend.product.brand', [
            'brands' => $brands,
        ]);
    }

    function brand_store(Request $request)
    {
        $uploaded_file = $request->brand_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->brand_name) . '.' . $extension);

        Image::make($uploaded_file)->save(public_path('/uploads/brand/' . $file_name));

        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_image' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        return back();
    }

    function brand_remove($brand_id)
    {
        $brand_image = Brand::find($brand_id)->brand_image;
        $deleted_from = public_path('/uploads/brand/' . $brand_image);
        unlink($deleted_from);

        Brand::find($brand_id)->delete();
        return back();
    }
}
