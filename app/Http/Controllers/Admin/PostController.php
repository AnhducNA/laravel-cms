<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        if ($request->get('users_id')) {
            $users_id = $request->get('users_id');
            $list_posts = Post::whereHas('user', function ($query) use ($users_id) {
                $query->where('id', $users_id);
            })
                ->with('category')->with('tags')
                ->paginate(10);
        } else if ($request->get('category_id')) {
            $category_id = $request->get('category_id');
            $list_posts = Post::whereHas('category', function ($query) use ($category_id) {
                $query->where('id', $category_id);
            })
                ->with('user')->with('category')->with('tags')
                ->paginate(10);
        } else if ($request->get('tags_id')) {
            $tags_id = $request->get('tags_id');
            $list_posts = Post::whereHas('tags', function ($query) use ($tags_id) {
                $query->where('tag_id', $tags_id);
            })
                ->with(['user', 'category', 'tags'])
                ->paginate(10);
        } else if ($request->get('status')) {
            $status = $request->get('status');
            $list_posts = Post::where('status', $status)
                ->with(['user', 'category', 'tags'])
                ->paginate(10);
        } else if (!empty($request->get('sort_col')) && !empty($request->get('sort_type'))) {
            $col = $request->get('sort_col');
            $sort_type = $request->get('sort_type');

            $list_posts = Post::with(['user', 'category', 'tags'])
                ->orderby($col, $sort_type)
                ->paginate(10);
//                ->get();
        } else {
            $list_posts = Post::with(['user', 'category', 'tags'])
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        $filePath = "";
        foreach ($list_posts as $key => $post) {
//            add image to s3 driver
            if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL) === FALSE){
                $filePath = "leanhduc/" . $post['thumbnail'];
                $list_posts[$key]['thumbnail'] = $this->getImageFromS3($filePath);
            }

//            get list name's tags of post
            $list_posts[$key]['list_name_tag'] = "";
            foreach ($post->tags as $key_tag => $tag) {
                if (count($post->tags) == ($key_tag + 1) || count($post->tags) == 1) {
                    $list_posts[$key]['list_name_tag'] = $list_posts[$key]['list_name_tag'] . $tag['name'] . ".";
                } else {
                    $list_posts[$key]['list_name_tag'] = $tag['name'] . ", " . $list_posts[$key]['list_name_tag'];
                }
            }

        }
        return view('admin.post.list', compact('list_posts'));
    }

    function getImageFromS3($filePath)
    {
        $path = Storage::cloud()->temporaryUrl(
            $filePath,
            Carbon::now()->addMinute(5)
        );
        return $path;
    }

    function show($id)
    {
        $post = Post::find($id);
        if (filter_var($post['thumbnail'], FILTER_VALIDATE_URL) === FALSE){
            $filePath = "leanhduc/" . $post['thumbnail'];
            $post['thumbnail'] = $this->getImageFromS3($filePath);
        }
        return view('admin.post.show', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required', 'max:255'],
        ]);
        if (!empty($request->list_id_tags)) {
            $data['list_id_tags'] = $request->list_id_tags;
        }
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);
        $data['created_at'] = Carbon::now()->toDateTimeString();
        if (!empty($request->thumbnail)) {
            $data['thumbnail'] = $request->thumbnail->getClientOriginalName();
            $this->uploadImageToS3($request->thumbnail);
        }
        $post = Post::create($data);
        Post::find($post->id)->tags()->detach();
        Post::find($post->id)->tags()->attach($data['list_id_tags']);

        return redirect(route('post.index'))->with('success', 'Data created successfully');
    }

    function uploadImageToS3($thumbnail_request)
    {
        $filePath = 'leanhduc/' . $thumbnail_request->getClientOriginalName();
        $path = Storage::disk('s3')->put($filePath, file_get_contents($thumbnail_request));
        $path = Storage::disk('s3')->url($path);
//        dd($path);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = '';
        $list_name_tag_of_post = "";
        return view('admin.post.form', compact('post',  'list_name_tag_of_post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $list_name_tag_of_post = "";
        if (!empty($post->tags)) {
            foreach ($post->tags as $key => $tag) {
                if (count($post->tags) == $key + 1) {
                    $list_name_tag_of_post = $tag['name'] . $list_name_tag_of_post;
                } else {
                    $list_name_tag_of_post = $tag['name'] . ", " . $list_name_tag_of_post;
                }
            }
        }
        return view('admin.post.form', compact('post', 'list_name_tag_of_post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required', 'max:255'],
            'status' => ['required'],
        ]);
        if (!empty($request->list_id_tags)) {
            $data['list_id_tags'] = $request->list_id_tags;
        } else{
            $data['list_id_tags'] = [];
        }
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        if (!empty($request->thumbnail)) {
            $data['thumbnail'] = $request->thumbnail->getClientOriginalName();
            $this->uploadImageToS3($request->thumbnail);
        }
//        dd($data);
        $post = Post::find($id);
        $post->tags()->detach();
        $post->tags()->attach($data['list_id_tags']);
        $post->update($data);
        return redirect(route('post.index'))->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();

        return redirect(route('post.index'))->with('success', 'Data deleted successfully');
    }
}
