@component('partials/fields/field', [
    'name' => $name,
    'label' => $label,
    'class' => $class ?? ''
])
    @php
        $attributes = $attributes ?? [];
        $attributes['class'] = 'form-input mt-1 block w-full '.($attributes['class'] ?? '');
    @endphp
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        @foreach($attributes as $attrKey => $attrValue)
            @if ($attrValue === false) @continue @endif
            {{ $attrKey }}="{{ $attrValue }}"
        @endforeach
    >
@endcomponent
