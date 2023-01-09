<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function welcome()
    {
        $recent_posts = Post::latest('created_at')->paginate(2);
        $categories = Category::all();
        $slider_post = Post::latest('created_at')->take(4)->get();
        return view('frontend.index', [
            'slider_post' => $slider_post,
            'categories' => $categories,
            'recent_posts' => $recent_posts,
        ]);
    }

    function category_post($category_id)
    {
        // $category_posts = Post::where('category_id', $category_id)->get();
        $category_posts = Post::where('category_id', $category_id)->paginate(2);
        // $category_paginate = Post::where('category_id', $category_id)->paginate(2);
        $category_info = Category::find($category_id);
        // $post_count = $category_posts->count();
        return  view('frontend.category_post', [
            'category_posts' => $category_posts,
            'category_info' => $category_info,
        ]);
    }

    function author_post($author_id)
    {
        $author_posts = Post::where('author_id', $author_id)->get();
        // $categories_info = Post::where('author_id', $author_id)->get();
        $categories = Category::all();
        $tags = Tag::all();
        $author_info = User::find($author_id);
        return  view('frontend.author_post', [
            'author_posts' => $author_posts,
            'author_info' => $author_info,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }


    function author_list()
    {
        $author_lists = Post::select('author_id')->groupBy('author_id')->selectRaw('author_id, sum(author_id) as sum')->get();
        return view('frontend.author_list', [
            'author_lists' => $author_lists,
        ]);
    }


    function post_details($slug)
    {
        $post_details = Post::where('slug', $slug)->get();
        $comments = Comment::with('replies')->where('post_id', $post_details->first()->id)->whereNull('parent_id')->get();

        return view('frontend.post_details', [
            'post_details' => $post_details,
            'comments' => $comments,

        ]);
    }

    function about()
    {
        return view('frontend.about');
    }

    function contact()
    {
        return view('frontend.contact');
    }

    function subscribe_store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscribes',
        ]);

        Subscribe::create([
            'email' => $request->email,
        ]);

        return back();
    }

    function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back();
    }
}
