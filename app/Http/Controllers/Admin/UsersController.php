<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }


    public function store(StoreUsersRequest $request)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create($request->all());

        if($request->has('roles')) {
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('admin.users.index')->with(['success' => 'User created']);
    }


    public function edit(User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(UpdateUsersRequest $request, User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->update($request->all());

        if($request->has('roles')) {
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('admin.users.index')->with(['success' => 'User Updated']);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }


    public function destroy(User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('admin.users.index')->with(['error' => 'User Deleted']);
    }


}
