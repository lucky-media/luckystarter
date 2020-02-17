<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(['name' => 'required']);

        $role = Role::create($request->except('permission'));

        if($request->has('permission')) {
            $role->givePermissionTo($request->input('permission'));
        }

        return redirect()->route('admin.roles.index')->with(['success' => 'Role created']);
    }


    public function edit(Role $role)
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(['name' => 'required']);

        $role->update($request->except('permission'));

        if($request->has('permission')) {
            $role->syncPermissions($request->input('permission'));
        }

        return redirect()->route('admin.roles.index')->with(['success' => 'Role Updated']);
    }


    public function show(Role $role)
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }


    public function destroy(Role $role)
    {
        abort_if(Gate::denies('roles_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('admin.roles.index')->with(['error' => 'Role Deleted']);
    }

}
