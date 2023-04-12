<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $list_post = Post::select('*')->where('category_id', 1)->orderBy('id', 'DESC')->paginate(5);
        $list_categories = Category::paginate(5);
        return view('client.index', compact('list_categories','list_post'));
    }
}
