@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
            Add Role
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Role list
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            ID
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
                                {{ $role->id ?? '' }}
                            </td>
                            <td>
                                {{ $role->name ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions()->pluck('name') as $permission)
                                    <span class="badge badge-info">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                    View
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                    Edit
                                </a>

                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection