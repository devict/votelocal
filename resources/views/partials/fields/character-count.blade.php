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
    <div x-data="{ text: '{{ $value }}' }">
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            @foreach($attributes as $attrKey => $attrValue)
                @if ($attrValue === false) @continue @endif
                {{ $attrKey }}="{{ $attrValue }}"
            @endforeach
        >{{ $value }}</textarea>
        <small
            class="text-gray-500"
            x-text="text.length + ' ' + ' character' + (text.length !== 1 ? 's' : '')">
        </small>
    </div>
@endcomponent
