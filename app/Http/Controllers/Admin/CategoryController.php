<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage_all|manage_category', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_categories = Category::with('users')->paginate(3);
        return view('admin.category.list', compact('list_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = '';
        $list_users = User::get();
        return view('admin.category.form', compact('category', 'list_users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);
        $data['user_id'] = Auth::id();

        $data['slug'] = Str::slug($data['name']);
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $category = Category::create($data);
        return redirect(route('category.index'))->with('success', __('Category created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $list_users = User::get();

        return view('admin.category.form', compact('category', 'list_users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name']);
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $category = Category::find($id)->update($data);
        return redirect(route('category.index'))->with('success', __('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect(route('category.index'))->with('success', __('Category deleted successfully.'));
    }

    function find_select2(Request $request){
        $term = $request->q;
        if (empty($term)) {
            return \Response::json([]);
        }

        $list_categories = Category::where('name', 'LIKE', "%".$term."%")->limit(5)->get();
        $formatted_categories = [];

        foreach ($list_categories as $category) {
            $formatted_categories[] = ['id' => $category->id, 'text' => $category->name];
        }

        return \Response::json($formatted_categories);
    }
}
