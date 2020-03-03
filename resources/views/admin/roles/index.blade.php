@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Roles</h4>
                        <div class="card-options">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-xs btn-outline-primary">Create
                                Role</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Permissions
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr data-entry-id="{{ $role->id }}">
                                    <td>
                                        {{ $role->id  }}
                                    </td>
                                    <td>
                                        {{ ucfirst($role->name) }}
                                    </td>
                                    <td>
                                        @foreach($role->permissions()->pluck('name') as $permission)
                                            <span class="badge badge-info">{{ $permission }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="icon"
                                           href="{{ route('admin.roles.edit', $role->id) }}">
                                            <i class="fe fe-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
