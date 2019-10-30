<div class="{{ $class }}">
    @if(! empty($label))
        <label for="{{ $name }}" class="block mb-1">{!! $label !!}</label>
    @endif

    {{ $slot }}

    @if ($errors->has($name))
        <span class="color text-red-500 mt-1">{{ $errors->first($name) }}</span>
    @endif
</div>
