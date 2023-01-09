<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function category()
    {
        $categories = Category::all();
        return view('admin.category.category', [
            'categories' => $categories
        ]);
    }

    function category_store(Request $request)
    {

        $request->validate([
            'category_name' => 'required',
            'cat_img' => 'required|mimes:jpg, png|file|max:512000',
        ]);

        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $uploaded_file = $request->cat_img;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . rand(100000, 999999) . '.' . $extension;
        Image::make($uploaded_file)->resize(300, 200)->save(public_path('uploads/category/' . $file_name));

        Category::find($category_id)->update([
            'cat_img' => $file_name,
        ]);

        return back()->withSuccess('Category added successfully!');
    }

    function category_delete($category_id)
    {
        $category_photo = Category::where('id', $category_id)->first()->cat_img;
        $delete_from = public_path('/uploads/category/' . $category_photo);
        unlink($delete_from);

        Category::find($category_id)->delete();
        return back()->with('delete', 'Deleted Successfully!');
    }

    function category_edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit_category', [
            'category' => $category
        ]);
    }

    function category_update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'cat_img' => 'required|mimes:jpg, png|file|max:512000'
        ]);

        if ($request->cat_img == '') {
            Category::find($request->id)->update([
                'category_name' => $request->category_name,
            ]);
        } else {

            $category_photo = Category::where('id', $request->id)->first()->cat_img;
            $delete_from = public_path('/uploads/category/' . $category_photo);
            unlink($delete_from);

            $uploaded_file = $request->cat_img;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '.' . $extension;
            Image::make($uploaded_file)->resize(250, 200)->save(public_path('/uploads/category/' . $file_name));

            Category::find($request->id)->update([
                'category_name' => $request->category_name,
                'cat_img' => $file_name,
            ]);
        }
    }
}
