<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $list_users = User::get();
        $list_posts = Post::get();
        return view('admin.dashboard', compact('list_users', 'list_posts'));
    }
}
