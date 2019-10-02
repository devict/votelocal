<nav class="flex items-center justify-between flex-wrap bg-white shadow py-3 px-4 md:px-12">
    <a href="{{ route('home') }}" class="block">
        <img class="h-8" src="https://www.voteict.org/img/logo.svg" title="Vote ICT">
    </a>
    <div class="leading-loose order-1 w-full items-center md:w-auto md:order-none mt-4 -mx-3 md:flex md:mx-0 md:mt-0 md:ml-auto">
        {!! $slot !!}
    </div>
    <div>
        @auth
            <dropdown class="ml-4" placement="bottom-end">
                <button class="flex items-center text-gray-500">
                    <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </button>
                <div slot="menu" class="mt-2 py-2 shadow-lg bg-white rounded text-sm">
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
            </dropdown>
        @endauth
    </div>
</nav>
