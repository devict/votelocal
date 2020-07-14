@props([
    'name' => null,
    'id' => $name,
    'label' => '',
])
@if ($label)
    <label for="{{ $id }}" class="block text-gray-700">{!! $label !!}</label>
@endif
<div class="relative rounded-md shadow-sm {{ $label ? 'mt-1' : '' }}">
    <input name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge([
        'class' => 'form-input block w-full',
        'aria-describedby' => $errors->has($name) ? "{$id}-error" : null,
    ]) }} />
</div>
@error($name)
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
@enderror
