@extends('layouts.base', ['background' => 'bg-gray-200'])

@section('content')
<header>
    @component('partials/main-menu')
        <a
            class="
                block px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*subscribers') ? 'text-red-500' : '' }}
                sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
            "
            href="{{ route('subscribers.admin.index') }}"
        >
            Subscribers
        </a>
        <a
            class="
                block px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*scheduled_messages') ? 'text-red-500' : '' }}
                sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
            "
            href="{{ route('scheduled_messages.admin.index') }}"
        >
            Scheduled Messages
        </a>
        <a
            class="
                block px-6 py-2 outline-none hover:bg-gray-200 focus:bg-gray-200 {{ Request::is('*tags') ? 'text-red-500' : '' }}
                sm:px-2 sm:py-0 sm:hover:text-red-500 sm:focus:text-red-500 sm:hover:bg-transparent sm:focus:bg-transparent
            "
            href="{{ route('tags.admin.index') }}"
        >
            Tags
        </a>
    @endcomponent
</header>
<main class="px-4 py-8 md:p-12">
    @yield('content')
</main>
@overwrite
