@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Role</h4>

                        <div class="card-options">
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-outline-danger">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <x-input name="name" label="Title*" type="text" required="true" :value="$role->name"></x-input>

                            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                <label for="permission">Permissions*</label>
                                <select name="permission[]" id="permission" class="form-control select-tags"
                                        multiple="multiple" required>
                                    @foreach($permissions as $id => $permissions)
                                        <option value="{{ $id }}"
                                        {{ $role->permissions()->pluck('name', 'id')->contains($id) ? 'selected' : '' }}
                                                >{{ $permissions }}
                                        </option>
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
