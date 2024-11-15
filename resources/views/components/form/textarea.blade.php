@props(
    ['type'=> 'text',
    'name'=> '',
    'value'=> '',
    'label'=>''
    ])
    <label for="">{{ $label }}</label>

    <textarea  name="{{ $name }}"{{ $attributes->class([
        'form-control',
        'is-invalid'=> $errors->has($name)])
        }}>{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
