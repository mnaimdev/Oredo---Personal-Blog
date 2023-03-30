<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



use Illuminate\Http\Request;

class RoleController extends Controller
{

    function role()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.role.role', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    function role_assign()
    {

        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();

        return view('admin.role.assign_role', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }


    function permission_store(Request $request)
    {
        Permission::create([
            'name' => $request->permission_name
        ]);
        return back();
    }

    function role_store(Request $request)
    {
        $role = Role::create([
            'name' => $request->role_name,
        ]);
        $role->givePermissionTo($request->permission);

        return back();
    }

    // function assign_role(Request $request)
    // {
    //     $user = User::find($request->user_id);
    //     $user->assignRole($request->role_id);

    //     return back();
    // }



    function edit_permission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);

        return back();
    }

    function edit_user_role($user_id)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::find($user_id);
        return view('admin.role.edit', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    function delete_user_role($user_id)
    {
        $user = User::find($user_id);
        $user->syncRoles([]);
        $user->syncPermissions([]);

        return back();
    }

    function remove_role($role_id)
    {
        Role::find($role_id)->delete();
        return back();
    }
}
