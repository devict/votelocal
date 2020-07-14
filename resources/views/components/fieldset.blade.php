@props(['label'])

<fieldset>
    <legend>{{ $label }}</legend>
    <div class="mt-1 border border-gray-300 rounded py-2 px-3">
        {{ $slot }}
    </div>
</fieldset>
