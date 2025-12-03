<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->route('roles.index');
    }

    public function assignRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->assignRole($request->role);
        return redirect()->back();
    }

    public function removeRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->removeRole($request->role);
        return redirect()->back();
    }
}
