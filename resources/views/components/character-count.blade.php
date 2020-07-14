@props([
    'name' => null,
    'id' => $name,
    'label' => '',
    'value' => '',
])
@if ($label)
    <label for="{{ $id }}" class="block text-gray-700">{!! $label !!}</label>
@endif
<div x-data="{ text: '{{ $value }}' }" class="relative rounded-md shadow-sm {{ $label ? 'mt-1' : '' }}">
    <textarea name="{{ $name }}" id="{{ $id }}" x-model="text" {{ $attributes->merge([
        'class' => 'form-textarea rounded-b-none block w-full relative focus:z-10',
        'aria-describedby' => $errors->has($name) ? "{$id}-error" : null,
    ]) }} >{{ $value }}</textarea>
    <small
        class="block px-4 py-1 text-gray-600 border border-gray-300 border-t-0 rounded-b-md"
        x-text="text.length + ' ' + ' character' + (text.length !== 1 ? 's' : '')">
    </small>
</div>
@error($name)
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
@enderror
