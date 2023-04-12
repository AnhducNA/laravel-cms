<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage_all|manage_user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_role = "";
        if ($request->get('search_option')) {
            $list_users = User::where($request->get('search_option'), 'LIKE', "%" . $request->get('search_value') . "%")->paginate(3);
        } elseif ($request->get('name_role')) {
            $list_users = User::with('roles')->paginate(3);
            $name_role = $request->get('name_role');
        } elseif ($request->get('email')) {
            $list_users = User::where('email', 'LIKE', "%" . $request->get('email') . "%")->paginate(3);
        } else {
            $list_users = User::paginate(3);
        }
        $list_role_attribute = Role::distinct('name')->pluck('name');
        $list_email_attribute = User::distinct('email')->pluck('email');
        $list_attribute = (new User())->getFillable();
        return view('admin.user.list', compact('list_users', 'name_role', 'list_attribute', 'list_role_attribute', 'list_email_attribute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => 'confirmed',
            'role_id' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $user = User::create($data);

        $role = Role::find($request->get('role_id'));
        $user->assignRole($role['name']);

        return redirect(route('user.index'))->with('success', __('User created successfully.'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_roles = Role::all();
//        dd($list_roles[0]);
        return view('admin.user.form', compact('list_roles'));
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
        $list_roles = Role::all();
        $user = User::find($id);
        $userRole = $user->roles->pluck('name', 'id')->all();
        return view('admin.user.form', compact('user', 'list_roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $now = Carbon::now();
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => 'confirmed',
            'role_id' => ['required']
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['created_at'] = $now->toDateTimeString();

        $user = User::find($id);
        $user->update($data);

        $role = Role::find($request->get('role_id'));

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($role['name']);
        return redirect()->route('user.index')
            ->withSuccess(__('Data updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
    function find_select2(Request $request){
        $term = $request->q;
        if (empty($term)) {
            return \Response::json([]);
        }
        $list_users = User::where('name', 'LIKE', "%".$term."%")->limit(5)->get();
        $formatted_users = [];

        foreach ($list_users as $user) {
            $formatted_users[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_users);
    }
}
