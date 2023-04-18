<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $list_post = Post::select('*')->orderBy('id', 'ASC')->paginate(5);
        $list_categories = Category::paginate(5);
        return view('client.index', compact('list_categories', 'list_post'));
    }

    function category($slug)
    {
        $list_categories = Category::paginate(5);
        $list_post_by_categoryID = Post::with('category')->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->simplePaginate(10);
        return view('client.category', compact('slug', 'list_post_by_categoryID', 'list_categories'));
    }
    function detail_post($slug)
    {
//        dd($post);
        $post = Post::with('category')->where('slug', $slug)->first();
//        increase viewpage
        $pageview = $post->pageview;
        $pageview++;
        Post::where('slug', $slug)->update(['pageview'=>$pageview]);
        $list_post_similar = Post::where('category_id', $post->category_id)->paginate(10);
        return view('client.detail-post', compact('post', 'list_post_similar'));
    }

    function search(Request $request)
    {
dd($request->search);
    }
}
