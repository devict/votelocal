@extends('layouts.base', ['background' => $background ?? ''])

@section('content')
    <header class="relative z-50 text-gray-600">
        @component('partials/main-menu')
           @auth('subscriber')
                <a
                    class="
                        group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*subscriber') ? 'text-gray-800' : '' }}
                        md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                    "
                    href="{{ route('subscriber.home') }}"
                >
                    <x-icon-home width="20" class="mr-2 group-hover:text-red-400 {{ Request::is('*subscriber') ? 'text-gray-700' : 'text-gray-400' }}" />
                    @lang('Home')
                </a>
            @endauth
            @guest('subscriber')
                <a
                    class="
                        group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*pledge') ? 'text-gray-800' : '' }}
                        md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                    "
                    href="{{ route('pledge') }}"
                >
                    <x-icon-checkmark-circle width="20" class="mr-2 group-hover:text-red-400 {{ Request::is('*pledge') ? 'text-gray-700' : 'text-gray-400' }}" />
                    @lang('Pledge')
                </a>
            @endguest
            <a
                class="
                    group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*resources') ? 'text-gray-800' : '' }}
                    md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                "
                href="{{ route('resources') }}"
            >
                <x-icon-diagonal-arrow-right-up width="20" class="mr-2 group-hover:text-red-400 {{ Request::is('*resources') ? 'text-gray-700' : 'text-gray-400' }}" />
                @lang('Resources')
            </a>
            <a
                class="
                    group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*archive') ? 'text-gray-800' : '' }}
                    md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                "
                href="{{ route('archive') }}"
            >
                <x-icon-archive width="20" class="mr-2 group-hover:text-red-400 {{ Request::is('*archive') ? 'text-gray-700' : 'text-gray-400' }}" />
                @lang('Archive')
            </a>
            @auth('subscriber')
                <a
                    class="
                        group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200
                        md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                    "
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    href="#"
                >
                    <x-icon-log-out width="20" class="mr-2 text-gray-400 group-hover:text-red-400" />
                    @lang('Logout')
                </a>
            @else
                <a
                    class="
                        group flex items-center px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*login') ? 'text-gray-800' : '' }}
                        md:px-2 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                    "
                    href="{{ route('subscriber.login') }}"
                >
                    <x-icon-log-in width="20" class="mr-2 group-hover:text-red-400 {{ Request::is('*login') ? 'text-gray-700' : 'text-gray-400' }}" />
                    @lang('Login')
                </a>
            @endauth

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @foreach(config('votelocal.locales') as $name => $locale)
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
                        group flex items-center px-6 py-2 outline-0 hover:bg-gray-200 focus:bg-gray-200
                        md:pl-4 md:py-0 md:hover:text-gray-800 md:focus:text-gray-800 md:hover:bg-transparent md:focus:bg-transparent
                    "
                    href="{{ url(implode('/', $segments)) }}"
                >
                    @svg($locale, 'text-gray-400 group-hover:text-red-500 mr-2 md:mr-0 md:text-gray-600', ['width' => 20])
                    <span class="md:hidden">{{ $name }}</span>
                </a>
            @endforeach
        @endcomponent
    </header>
    <main>
        @include('partials.flash')
        @yield('content')
    </main>
@overwrite
