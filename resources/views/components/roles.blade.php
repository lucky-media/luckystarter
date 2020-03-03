<div class="form-group">
    <label for="roles">Roles*</label>
    <select name="roles[]" id="roles" class="form-control select-tags" multiple="multiple"
            required>
        @foreach($roles as $id => $roles)
            <option value="{{ $id }}" {{ isset($user) ?  $user->roles()->pluck('name', 'id')->contains($id) ? 'selected' : ''  : '' }}>{{ $roles }}</option>
        @endforeach
    </select>

    @error('roles')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
