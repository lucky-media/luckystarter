<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUsersRequest $request)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param UpdateUsersRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('users_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('admin.users.index');
    }


}
