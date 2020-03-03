<div class="form-group">
    <label for="{{ $name }}">{{ $capital }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
           {{ $isRequired }}
            {{ $attributes }}
        >

    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
