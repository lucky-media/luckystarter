@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>

                        <div class="card-options">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-outline-danger">
                                    <i class="fe fe-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route("admin.users.update", [ $user->id ]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" id="name" name="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       value="{{ $user->name }}"
                                       required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" id="email" name="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       value="{{ $user->email }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="roles">Roles*</label>
                                <select name="roles[]" id="roles" class="form-control select-tags" multiple="multiple"
                                        required>
                                    @foreach($roles as $id => $roles)
                                        <option value="{{ $id }}" {{ $user->roles()->pluck('name', 'id')->contains($id) ? 'selected' : '' }}>{{ $roles }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
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
        </div>
    </div>

@endsection