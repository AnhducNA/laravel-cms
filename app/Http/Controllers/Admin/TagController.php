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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();
        return redirect(route('tag.index'))->with('success', __('Tag deleted successfully.'));
    }
}
