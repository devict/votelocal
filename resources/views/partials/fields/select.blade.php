@component('partials/fields/field', [
    'name' => $name,
    'label' => $label,
    'class' => $class ?? '',
    'helpText' => $helpText ?? '',
    'errorMessage' => $errorMessage ?? ''
])
    @php
        $attributes = $attributes ?? [];
        $attributes['class'] = 'form-select block w-full '.($attributes['class'] ?? '');
    @endphp
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @foreach($attributes as $attrKey => $attrValue)
            {{ $attrKey }}="{{ $attrValue }}"
        @endforeach
    >
        @foreach($options as $optionValue => $optionLabel)
            @if ($attrValue === false) @continue @endif
            <option value="{{ $optionValue }}"{{ $optionValue === $value ? ' selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
@endcomponent
