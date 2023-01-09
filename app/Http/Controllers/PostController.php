<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;

class PostController extends Controller
{
    function add_post()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.add_post', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    function post_store(Request $request)
    {
        $request->validate([
            'feat_image' => 'required',
        ]);

        $slug = Str::lower(str_replace(' ', '-', $request->title)) . '-' . rand(10000000, 99999999999);


        $post_id = Post::insertGetId([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author_id' => Auth::id(),
            'short_desp' => $request->short_desp,
            'desp' => $request->desp,
            'slug' => $slug,
            'created_at' => Carbon::now(),
        ]);

        $after_implode_tag = implode(',', $request->tag_id);

        $uploaded_file = $request->feat_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(Str_replace(' ', '-', Auth::user()->name)) . '-' . rand(1000000, 99999999) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/post/' . $file_name));

        Post::find($post_id)->update([
            'feat_image' => $file_name,
            'tag_id' => $after_implode_tag,
        ]);

        return back();
    }

    function show_post()
    {
        $mypost = Post::where('author_id', Auth::id())->get();
        return view('admin.post.show_post', [
            'mypost' => $mypost,
        ]);
    }

    function post_view($post_id)
    {
        $post = Post::find($post_id);
        return view('admin.post.view_post', [
            'post' => $post,
        ]);
    }

    function post_delete($post_id)
    {
        $post_img = Post::find($post_id)->feat_image;
        $delete_from = public_path('/uploads/post/' . $post_img);
        unlink($delete_from);

        Post::find($post_id)->delete();
        return back();
    }

    function post_edit($post_id)
    {
        $categories = Category::all();
        $post_info = Post::find($post_id);
        $tags = Tag::all();
        return view('admin.post.edit_post', [
            'post_info' => $post_info,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    function post_edit_store(Request $request)
    {
        $after_implode_tag = implode(',', $request->tag_id);

        if ($request->feat_image == null) {
            Post::find($request->post_id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'author_id' => Auth::id(),
                'short_desp' => $request->short_desp,
                'desp' => $request->desp,
                'tag_id' => $after_implode_tag,
            ]);

            return back();
        } else {

            $post_img = Post::find($request->post_id)->feat_image;
            $delete_from = public_path('/uploads/post/' . $post_img);
            unlink($delete_from);

            $uploaded_file = $request->feat_image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(Str_replace(' ', '-', Auth::user()->name)) . '-' . rand(100000, 99999999999) . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/post/' . $file_name));

            Post::find($request->post_id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'author_id' => Auth::id(),
                'desp' => $request->desp,
                'tag_id' => $after_implode_tag,
                'feat_image' => $file_name,
            ]);

            return back();
        }
    }
}
