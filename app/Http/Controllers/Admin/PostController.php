<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage_all|manage_article', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_posts = Post::with('user')->with('category')->with('tag')->paginate(3);
        return view('admin.post.list', compact('list_posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->toDateTimeString();
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['created_at'] = $now;
//        dd($data);

        $post = Post::create($data);
        return redirect(route('post.index'))->with('success', 'Data created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = '';
        $list_users = User::get();
        $list_tags = Tag::get();
        $list_categories = Category::get();
        return view('admin.post.form', compact('post', 'list_categories', 'list_users', 'list_tags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
//        dd($post->tag_id);
        $list_users = User::get();
        $list_tags = Tag::get();
        $list_categories = Category::get();
        return view('admin.post.form', compact('post', 'list_categories', 'list_users', 'list_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $post = Post::find($id)->update($data);
        return redirect(route('post.index'))->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();
        $list_posts = Post::with('user')->with('category')->with('tag')->paginate(3);
        return view('admin.post.list', compact('list_posts'))->with('success', 'Data deleted successfully');
    }
}
