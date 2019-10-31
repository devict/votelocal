@extends('layouts.base', ['background' => $background ?? ''])

@section('content')
    <header class="relative z-50 text-gray-600">
        @component('partials/main-menu')
            <a
                class="
                    flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*archive') ? 'text-red-500' : '' }}
                    sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
                "
                href="{{ route('resources') }}"
            >
                @lang('resources.page_title')
            </a>
            <a
                class="
                    flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*archive') ? 'text-red-500' : '' }}
                    sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
                "
                href="{{ route('archive') }}"
            >
                @include('partials.icon', [
                    'name' => 'archive',
                    'width' => '20',
                    'height' => '20',
                    'class' => 'inline-block mr-2'
                ])
                Message Archive
            </a>
            @foreach(config('voteict.locales') as $name => $locale)
                @php
                    $current = App::getLocale();
                    $segments = Request::segments();
                    if ($current === 'en') {
                        array_unshift($segments, $locale);
                    } else {
                        $segments[0] = $locale !== 'en' ? $locale : '' ;
                    }
                    if ($current === $locale) {
                        continue;
                    }
                @endphp
                <a
                    class="
                        flex items-center px-6 py-2 outline-0 hover:bg-gray-200 focus:bg-gray-200
                        sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
                    "
                    href="{{ url(implode('/', $segments)) }}"
                >
                    @include('partials.icon', [
                        'name' => $locale,
                        'width' => '20',
                        'height' => '20',
                        'class' => 'inline-block mr-2'
                    ])
                    <span class="sm:hidden">{{ $name }}</span>
                </a>
            @endforeach
        @endcomponent
    </header>
    <main>
        @if (session('status'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <p class="my-0">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </main>
@overwrite
