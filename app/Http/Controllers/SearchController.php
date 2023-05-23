<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request)
    {
        $data = $request->all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        // default sort
        $sorting = 'created_at';
        $type = 'DESC';

        if (!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined') {
            if ($data['sort'] == 1) {
                $sorting = 'product_name';
                $type = 'ASC';
            } else if ($data['sort'] == 2) {
                $sorting = 'product_name';
                $type = 'DESC';
            } else if ($data['sort'] == 3) {
                $sorting = 'after_discount';
                $type = 'ASC';
            } else if ($data['sort'] == 4) {
                $sorting = 'after_discount';
                $type = 'DESC';
            }
        }

        // search products
        $searched_products = Product::where(function ($q) use ($data) {
            // global search
            if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('product_name', 'like', '%' . $data['q'] . '%');
                    $q->orWhere('long_desp', 'like', '%' . $data['q'] . '%');
                });
            }

            $min = 0;
            $min = 0;

            // min
            if (!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined') {
                $min = $data['min'];
            } else {
                $min = 1;
            }

            //max
            if (!empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined') {
                $max = $data['max'];
            } else {
                $max = 300000;
            }

            // price filter
            if (!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined') {
                $q->whereBetween('after_discount', [$min, $max]);
            }

            // category filter
            if (!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined') {
                $q->where('category_id', $data['category_id']);
            }

            // brand filter
            if (!empty($data['brand_id']) && $data['brand_id'] != '' && $data['brand_id'] != 'undefined') {
                $q->where('brand_id', $data['brand_id']);
            }


            // color, size filter
            if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined') {
                $q->whereHas('rel_to_invetories', function ($q) use ($data) {
                    // color
                    if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined') {
                        $q->whereHas('rel_to_color', function ($q) use ($data) {
                            $q->where('color_id', $data['color_id']);
                        });
                    }

                    // size
                    if (!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined') {
                        $q->whereHas('rel_to_size', function ($q) use ($data) {
                            $q->where('size_id', $data['size_id']);
                        });
                    }
                });
            }
        })->orderBy($sorting, $type)->get();

        return view('search.search', [
            'searched_products'         => $searched_products,
            'categories'                => $categories,
            'brands'                    => $brands,
            'colors'                    => $colors,
            'sizes'                     => $sizes,
        ]);
    }
}
