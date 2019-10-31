<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ url('safari-pinned-tab.svg') }}" color="#ee215a">
    <meta name="msapplication-TileColor" content="#ee215a">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=News+Cycle|Rubik" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('*resources') ? ' active' : '' }}" href="{{ route('resources') }}">@lang('resources.page_title')</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('*archive') ? ' active' : '' }}" href="{{ route('archive') }}">Archive</a>
                        </li>

                        @if (! Request::is('admin*'))
                            <li class="d-flex align-items-center ml-md-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    @foreach(config('voteict.locales') as $name => $locale)
                                        @php
                                            $current = App::getLocale();
                                            $segments = Request::segments();
                                            if ($current === 'en') {
                                                array_unshift($segments, $locale);
                                            } else {
                                                $segments[0] = $locale !== 'en' ? $locale : '' ;
                                            }
                                        @endphp
                                        @if($current === $locale)
                                            <span class="btn btn-light active">{{ $name }}</span>
                                        @else
                                            <a
                                                class="btn btn-light"
                                                href="{{ url(implode('/', $segments)) }}"
                                            >{{ $name }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        @endif

                        <!-- Authentication Links -->
                        @guest
                            <!-- Hidden login and register links -->
                        @else
                            <li class="nav-item dropdown ml-md-4">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/admin">Admin Dashboard</a>
                                    <a class="dropdown-item" href="/admin/subscribers">Subscribers List</a>
                                    <a class="dropdown-item" href="/admin/scheduled_messages">Scheduled Messages</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
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
    </div>
</body>
</html>
