@props([
    'name',
    'checked',
    'options',
])
@foreach ($options as $key => $value)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $key }}"
            @checked(old($name, $checked) == $key)
            {{ $attributes->class(['form-control-input', 'is-invalid' => $errors->has($name)]) }}>
        <label class="form-check-label" for="{{ $key }}">
            {{ $value }}
        </label>
    </div>
@endforeach
