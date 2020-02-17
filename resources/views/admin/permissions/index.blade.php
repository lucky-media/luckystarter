@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Create Permission
                    </div>
                    <div class="card-body">
                        <form action="{{ route("admin.permissions.store") }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Title*</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name', isset($permission) ? $permission->name : '') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div>
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        All Permissions
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    <td>
                                        {{ $permission->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $permission->name ?? '' }}
                                    </td>
                                    <td>
                                        <a class="icon" href="{{ route('admin.permissions.edit', $permission->id) }}">
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