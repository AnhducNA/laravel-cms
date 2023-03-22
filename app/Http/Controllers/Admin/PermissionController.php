<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_permissions = Permission::with('roles')->paginate(3);
        $list_attribute = (new Permission())->getFillable();
        return view('admin.permission.list', compact('list_permissions', 'list_attribute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->get('name')]);
        Permission::find($permission->id)->syncRoles($request->get('roles'));

        return redirect(route('permission.index'))
            ->with('success', 'Permission created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = '';
        $name_role_has_permission = '';
        $list_roles = Role::get();
        return view('admin.permission.form', compact('list_roles', 'permission', 'name_role_has_permission'));
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
        $permission = Permission::find($id);
        $list_roles = Role::get();
        $name_role_has_permission = $permission->getRoleNames();
        $name_role_has_permission = implode('', [$name_role_has_permission]);
        return view('admin.permission.form', compact('permission','list_roles', 'name_role_has_permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);
        $permission->update(['name' => $request->get('name')]);
        $permission->syncRoles($request->get('roles'));
        return redirect(route('permission.index'))
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
