<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

class CategoryController extends Controller
{

    function category()
    {
        $categories = Category::all();
        return view('backend.category.category', [
            'categories' => $categories,
        ]);
    }

    function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
            'cat_img' => 'required|mimes:png,jpg|file|max:10000',
        ]);

        $uploaded_file = $request->cat_img;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/category/' . $file_name));

        Category::create([
            'category_name' => $request->category_name,
            'cat_img' => $file_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('category', 'Category has been added');
    }

    function category_delete($category_id)
    {
        $category_image = Category::find($category_id)->cat_img;
        $deleted_from = public_path('/uploads/category/' . $category_image);
        unlink($deleted_from);

        Category::find($category_id)->delete();
        return back()->with('category_del', 'Category has been deleted!');
    }

    function category_edit($category_id)
    {
        $category = Category::find($category_id);

        return view('backend.category.edit_category', [
            'category' => $category,
        ]);
    }

    function category_update(Request $request)
    {
        if ($request->cat_img == '') {
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
            ]);

            return back()->with('category_update', 'Category has been updated!');
        }

        // else
        else {
            $cat_img = Category::find($request->category_id)->cat_img;
            $deleted_from = public_path('/uploads/category/' . $cat_img);
            unlink($deleted_from);

            $uploaded_file = $request->cat_img;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '.' . $extension;

            Image::make($uploaded_file)->save(public_path('/uploads/category/' . $file_name));

            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'cat_img' => $file_name,
            ]);

            return back()->with('category_update', 'Category has been updated!');
        }
    }
}
