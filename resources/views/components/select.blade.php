@props([
    'name' => null,
    'id' => $name,
    'label' => '',
    'options' => [],
    'value' => '',
])
@if ($label)
    <label for="{{ $id }}" class="block text-gray-700">{!! $label !!}</label>
@endif
<div class="relative rounded-md shadow-sm {{ $label ? 'mt-1' : '' }}">
    <select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge([
        'class' => 'form-select block w-full',
        'aria-describedby' => $errors->has($name) ? "{$id}-error" : null,
    ]) }}>
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}"{{ (string) $optionValue === (string) $value ? ' selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
@error($name)
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
@enderror
