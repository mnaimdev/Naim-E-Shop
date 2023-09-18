<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    function role()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('backend.role.role', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    function role_store(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);



        // insert data role table
        $role = Role::insertGetId([
            'name' => $request->role
        ]);

        // $role->givePermissionTo($request->permission);

        foreach ($request->permission as $permission) {
            DB::table('role_has_permissions')->insert([
                'role_id'       => $role,
                'permission_id' => $permission,
            ]);
        }

        return back();
    }

    function remove_role($role_id)
    {
        Role::find($role_id)->delete();
        return back()->with('remove_role', 'Role has been removed!');
    }



    function edit_role($role_id)
    {
        $permissions = Permission::all();
        $roles = Role::find($role_id);

        return view('backend.role.edit_role', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    function role_update(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);

        return back()->with('edit_role', 'Role has been updated successfully!');
    }



    // Assign Role


    function role_assign()
    {
        $users = User::all();
        $roles = Role::all();
        return view('backend.role.assign_role', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }


    function assign_user_role(Request $request)
    {
        $user = User::find($request->user_id);

        $user->assignRole($request->role_id);

        return back()->with('assign', 'User role assigned :)');
    }

    function delete_user_permission($user_id)
    {
        $user = User::find($user_id);
        $user->syncPermissions([]);
        $user->syncRoles([]);

        return back();
    }

    function edit_user_permission($user_id)
    {
        $user = User::find($user_id);
        $role = $user->getRoleNames();
        $permissions = Permission::all();
        return view('backend.role.edit_user_permission', [
            'user' => $user,
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    function update_user_permission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);

        return back();
    }
}
