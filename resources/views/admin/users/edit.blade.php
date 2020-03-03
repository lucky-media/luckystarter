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

                            <x-input name="name" label="Name*" type="text" required="true" :value="$user->name"></x-input>

                            <x-input name="email" label="Email*" type="email" required="true" :value="$user->email"></x-input>

                            <x-input name="password" label="Password*" type="password" required="false" :value="old('password')"></x-input>

                            <x-roles :roles="$roles" :user="$user"></x-roles>

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
