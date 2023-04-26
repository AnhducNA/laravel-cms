<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_tags = Tag::with('user')->paginate(3);
        return view('admin.tag.list', compact('list_tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = '';
        $list_users = User::get();
        return view('admin.tag.form', compact('tag', 'list_users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'user_id' => ['required']
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $tag = Tag::create($data);
        return redirect(route('tag.index'))->with('success', __('Tag created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        $list_users = User::get();
        return view('admin.tag.form', compact('tag', 'list_users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required'],
            'user_id' => ['required']
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $tag = Tag::find($id)->update($data);
        return redirect(route('tag.index'))->with('success', __('Tag updated successfully.'));
    }

    function show($slug){
        $list_posts = Post::whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->with(['user', 'tags'])->paginate(3);
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
        return view('admin.tag.show', compact('list_posts'));
    }
    function getImageFromS3($filePath)
    {
        $path = Storage::cloud()->temporaryUrl(
            $filePath,
            Carbon::now()->addMinute(5)
        );
        return $path;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();
        return redirect(route('tag.index'))->with('success', __('Tag deleted successfully.'));
    }
    public function find_select2(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }

        $tags = Tag::where('name', 'LIKE', "%".$term."%")->limit(5)->get();
        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return \Response::json($formatted_tags);
    }
}
