<a
    href="{{ $url }}"
    target="{{ $target ?? '' }}"
    class="block text-lg p-4 rounded-lg flex items-start mb-6 hover:bg-gray-100"
>
    <div class="p-2 rounded-full shadow-lg mr-6 bg-{{ $color }}-100">
        <x-icon-diagonal-arrow-right-up width="40" class="block text-{{ $color }}-500" />
    </div>
    <div>
        <h2 class="text-2xl font-display font-medium text-{{ $color }}-500">{{ $title }}</h2>
        <p>{{ $description }}</p>
        <span class="text-gray-600">{{ str_replace('www.', '', parse_url($url, PHP_URL_HOST)) }}<span>
    </div>
</a>
