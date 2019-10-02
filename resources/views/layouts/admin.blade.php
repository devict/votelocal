@extends('layouts.base')

@section('content')
<header>
        @component('partials/main-menu')
            <a
                class="block px-3 hover:text-red-500 focus:text-red-500{{ Request::is('*subscribers') ? ' text-red-500' : '' }}"
                href="{{ route('subscribers.admin.index') }}"
            >
                Subscribers
            </a>
            <a
                class="block px-3 hover:text-red-500 focus:text-red-500{{ Request::is('*scheduled_messages') ? ' text-red-500' : '' }}"
                href="{{ route('scheduled_messages.admin.index') }}"
            >
                Scheduled Messages
            </a>
        @endcomponent
    </header>
    <main class="px-4 py-8 md:p-12">
        @yield('content')
    </main>
@overwrite
