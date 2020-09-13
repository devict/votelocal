@props([
    'label' => null,
])

<label class="inline-flex items-center">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-checkbox w-4 h-4']) }}>
    <span class="ml-2">{{ $label }}</span>
</label>
