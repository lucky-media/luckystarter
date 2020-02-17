@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Create User
                    </div>

                    <div class="card-body">
                        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" id="name" name="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       value="{{ old('name') }}"
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
                                       value="{{ old('email') }}" required>
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
                                        <option value="{{ $id }}">{{ $roles }}</option>
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