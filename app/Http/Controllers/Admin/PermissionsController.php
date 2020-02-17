<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('permissions_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('permissions_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(['name' => 'required']);

        Permission::create($request->all());

        return back()->with(['success' => 'Permission Created']);
    }


    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permissions_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }


    public function update(Request $request, Permission $permission)
    {
        abort_if(Gate::denies('permissions_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate(['name' => 'required']);

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index')->with(['success' => 'Permission Updated']);
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permissions_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with(['error' => 'Permission Deleted']);
    }

}
