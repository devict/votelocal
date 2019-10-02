@component('partials/fields/field', [
    'name' => $name,
    'label' => $label,
    'class' => $class ?? '',
    'helpText' => $helpText ?? '',
    'errorMessage' => $errorMessage ?? ''
])
    @php
        $attributes = $attributes ?? [];
        $attributes['class'] = 'form-textarea block w-full '.($attributes['class'] ?? '');
    @endphp
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        @foreach($attributes as $attrKey => $attrValue)
            @if ($attrValue === false) @continue @endif
            {{ $attrKey }}="{{ $attrValue }}"
        @endforeach
    >{{ $value }}</textarea>
@endcomponent
