<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_roles = Role::with('permissions')->paginate(3);
        return view('admin.role.list', compact('list_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
//        dd($role->getAllPermissions());

        return redirect(route('role.index'))
            ->with('success', 'Role created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = '';
        $name_permission_of_role = '';
        $list_permission = Permission::get();
        return view('admin.role.form', compact('list_permission', 'role', 'name_permission_of_role'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $list_permission = Permission::all();
        $name_permission_of_role = [];
        foreach ($role->getAllPermissions() as $permission){
            $name_permission_of_role[$permission['id']] = $permission['name'];
        }
        $name_permission_of_role = implode(' + ', $name_permission_of_role);
        return view('admin.role.form', compact('role','list_permission', 'name_permission_of_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->update(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permissions'));
        return redirect(route('role.index'))
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        return redirect()->route('role.index')
            ->with('success', 'Role deleted successfully');
    }
}
