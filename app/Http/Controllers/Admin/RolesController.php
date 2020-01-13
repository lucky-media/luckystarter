<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return Factory|View
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRolesRequest $request)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = Role::create($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);

        return redirect()->route('admin.roles.index');
    }


    /**
     * Show the form for editing Role.
     *
     * @param Role $role
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update Role in storage.
     *
     * @param UpdateRolesRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRolesRequest $request, Role $role)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }


    /**
     * Remove Role from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('admin.roles.index');
    }

}
