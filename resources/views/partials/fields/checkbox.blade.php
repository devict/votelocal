@component('partials/fields/field', [
    'name' => $name,
    'label' => '',
    'class' => '',
])
    @php
        $attributes = $attributes ?? [];
        $attributes['class'] = 'form-checkbox '.($attributes['class'] ?? '');
    @endphp
    <label class="inline-flex items-center {{ $class ?? '' }}">
        <input
            type="checkbox"
            name="{{ $name }}"
            @if($checked) checked @endif
            @foreach($attributes as $attrKey => $attrValue)
                @if ($attrValue === false) @continue @endif
                {{ $attrKey }}="{{ $attrValue }}"
            @endforeach
        >
        <span class="ml-2">{{ $label }}</span>
    </label>
@endcomponent
