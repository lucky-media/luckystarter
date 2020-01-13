<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Permission::create($request->all());

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param Permission $permission
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, Permission $permission)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return redirect()->route('admin.permissions.index');
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.show', compact('permission'));
    }
}
