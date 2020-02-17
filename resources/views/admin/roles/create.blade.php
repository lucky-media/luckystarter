@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        Create Role
                    </div>

                    <div class="card-body">
                        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title*</label>
                                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                <label for="permission">Permissions*</label>
                                <select name="permission[]" id="permission" class="form-control select-tags"
                                        multiple="multiple"
                                        required>
                                    @foreach($permissions as $id => $permissions)
                                        <option value="{{ $id }}">{{ $permissions }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input class="btn btn-danger" type="submit" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection