@if ($paginator->hasPages())
    <div class="mt-6 -mb-1 flex flex-wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded text-gray-500">
                &laquo; @lang('Previous')
            </span>
        @else
            <a
                class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded hover:bg-white focus:border-blue-500 focus:text-blue-500"
                href="{{ $paginator->previousPageUrl() }}"
                rel="prev"
            >&laquo;  @lang('Previous')</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded text-gray-500">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded text-blue-500 bg-white">
                            {{ $page }}
                        </span>
                    @else
                        <a
                            class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded hover:bg-white focus:border-blue-500 focus:text-blue-500"
                            href="{{ $url }}"
                        >{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a
                class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded hover:bg-white focus:border-blue-500 focus:text-blue-500 ml-auto"
                href="{{ $paginator->nextPageUrl() }}"
                rel="next"
            >@lang('Next') &raquo;</a>
        @else
            <span class="mr-1 mb-1 px-3 py-2 text-sm border border-gray-400 rounded text-gray-500 ml-auto">
                @lang('Next') &raquo;
            </span>
        @endif
    </div>
@endif
