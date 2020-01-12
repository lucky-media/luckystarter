

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Change password
    </div>

    <div class="card-body">
        <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                <label for="current_password">Current password *</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                <label for="new_password">New password *</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
                @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                <label for="new_password_confirmation">New password confirmation *</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                @error('new_password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Save">
            </div>
        </form>


    </div>
</div>
@endsection