<nav class="flex items-center justify-between flex-wrap bg-white shadow py-3 px-4 md:px-12">
    <a href="{{ route('home') }}" class="block">
        <img class="h-8" src="{{ asset('img/logo.svg') }}" title="Vote Local KS">
    </a>
    <div class="flex">
        <div class="hidden lg:flex leading-loose order-1 w-full items-center mt-4 -mx-3 md:flex md:mx-0 md:mt-0 md:ml-auto md:w-auto md:order-none">
            {!! $slot !!}
        </div>
        <div class="md:hidden">
            @component('components.dropdown', [
                'buttonClass' => 'flex items-center text-gray-500 hover:text-red-500',
                'position' => 'right-0',
            ])
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.94824 6H20.0512C20.5732 6 21.0002 6.427 21.0002 6.949V7.051C21.0002 7.573 20.5732 8 20.0512 8H3.94824C3.42624 8 3.00024 7.573 3.00024 7.051V6.949C3.00024 6.427 3.42624 6 3.94824 6ZM20.0512 11H3.94824C3.42624 11 3.00024 11.427 3.00024 11.949V12.051C3.00024 12.573 3.42624 13 3.94824 13H20.0512C20.5732 13 21.0002 12.573 21.0002 12.051V11.949C21.0002 11.427 20.5732 11 20.0512 11ZM20.0512 16H3.94824C3.42624 16 3.00024 16.427 3.00024 16.949V17.051C3.00024 17.573 3.42624 18 3.94824 18H20.0512C20.5732 18 21.0002 17.573 21.0002 17.051V16.949C21.0002 16.427 20.5732 16 20.0512 16Z"/>
                </svg>
                @slot('menu')
                    <div class="w-56 mt-2 py-2 shadow-lg bg-white rounded text-sm text-gray-700">
                        {!! $slot !!}
                    </div>
                @endslot
            @endcomponent
        </div>
        <div class="flex items-center ml-4">
            @auth
                @component('components.dropdown', [
                    'buttonClass' => 'flex items-center text-gray-500 hover:text-red-500',
                    'position' => 'right-0',
                ])
                    <img class="w-6 h-6 rounded-full shadow-inner" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                    <x-icon-arrow-down width="20" class="ml-1" />
                    @slot('menu')
                        <div class="w-56 mt-2 py-2 shadow-lg bg-white rounded text-sm text-gray-700">
                            <a href="{{ route('dashboard') }}" class="block px-6 py-2 hover:bg-gray-200 focus:bg-gray-200">
                                Dashboard
                            </a>
                            <a
                                href="{{ route('logout') }}"
                                class="block px-6 py-2 hover:bg-gray-200 focus:bg-gray-200"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endslot
                @endcomponent
            @endauth
        </div>
    </div>
</nav>
