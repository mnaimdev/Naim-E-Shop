<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    function subcategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('backend.category.sub_category', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function subcategory_store(Request $request)
    {

        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ]);

        Subcategory::create([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('subcategory', 'Subcategory added :)');
    }

    function edit_subcategory($subcategory_id)
    {
        $subcategory_info = Subcategory::find($subcategory_id);
        $categories = Category::all();
        return view('backend.category.edit_subcategory', [
            'subcategory_info' => $subcategory_info,
            'categories' => $categories,
        ]);
    }

    function delete_subcategory($subcategory_id)
    {
        Subcategory::find($subcategory_id)->delete();
        return back()->with('del_sub', 'Subcategory has been deleted!');
    }

    function subcategory_update(Request $request)
    {
        Subcategory::find($request->subcategory_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
        ]);

        return back()->with('update_sub', 'Subcategory has been updated!');
    }
}
