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
                        <form action="{{ route("admin.users.store") }}" method="POST">
                            @csrf
                            <x-input name="name" label="Name*" type="text" required="true" :value="old('name')"></x-input>

                            <x-input name="email" label="Email*" type="email" required="true" :value="old('email')"></x-input>

                            <x-input name="password" label="Password*" type="password" required="false" :value="old('password')"></x-input>

                            <x-roles :roles="$roles"></x-roles>

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
