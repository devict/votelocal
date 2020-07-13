<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full {{ $background ?? '' }}">
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

    <!-- Twitter card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@VoteLocalKS">
    <meta name="twitter:creator" content="@VoteLocalKS">
    <meta name="twitter:image" content="{{ asset('img/social.png') }}">
    <meta name="twitter:image:alt" content="Vote Local KS: Voter information for South Central KS">

    <!-- Open Graph data -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="Vote Local">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:description" content="Get text message notifications with relevant information about local elections in Wichita.">
    <meta property="og:image" content="{{ asset('img/social.png') }}">
    <meta property="og:site_name" content="Vote Local">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans text-gray-800 antialiased">
    <div id="app">
        <portal-target name="dropdown" slim></portal-target>
        @yield('content')
    </div>
</body>
</html>
