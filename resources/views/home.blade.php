@extends('layouts.app')

@section('content')
<header class="relative">
    <svg class="absolute top-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 524" fill="none" preserveAspectRatio="none">
        <path d="M-2.29048e-05 6.10352e-05L0.000755813 524C0.000755813 524 208.527 439.984 382.411 428.445C556.189 416.913 626.874 463.72 859.963 399.76C1093.05 335.8 1280 128.084 1280 128.084L1280 5.08459e-06L798.707 2.61226e-05L463.791 4.07622e-05L-2.29048e-05 6.10352e-05Z" fill="#C7E6FA"/>
    </svg>
    <div class="relative">
        <div class="max-w-5xl mx-auto sm:flex justify-between md:items-center pt-8 md:pt-16">
            <div class="px-4 sm:px-8 sm:w-1/2">
                <h1 class="text-2xl font-medium leading-tight font-display mb-56 text-center sm:text-left sm:mb-4 sm:text-3xl sm:text-4xl">@lang('Welcome to VoteLocalKS.org')</h1>
                <p class="text-lg leading-normal mb-8">@lang('Get text message notifications with relevant information about local elections in Kansas.')</p>
                <div class="sm:pb-24">
                    <a class="btn bg-red-500 hover:bg-red-600 focus:bg-red-600 block sm:inline-block mb-4 sm:mr-3" href="{{ route('subscriber.login') }}">
                        @lang('Get started now!')
                    </a>
                    <a class="btn block sm:inline-block" href="#steps">
                        @lang('Learn more')
                        <x-icon-arrow-downward width="16" class="text-current inline-block" />
                    </a>
                </div>
            </div>
            <div class="absolute top-0 mt-20 w-full sm:static sm:w-1/2 sm:mt-0 lg:mb-16">
                @include('partials.bubbles')
            </div>
        </div>
    </div>
</header>

<section id="steps" class="max-w-5xl mx-auto px-8 py-10 sm:py-20">
    <div class="sm:flex -mx-4">
        <div class="sm:w-1/3 px-4 mb-8 sm:mb-0">
            <h2 class="text-2xl font-medium font-display">@lang('Step') 1</h2>
            <p><a href="{{ route('subscriber.login') }}" class="text-link">@lang('Click here')</a> @lang('to provide your number and start your subscription (100% free).')</p>
        </div>
        <div class="sm:w-1/3 px-4 mb-8 sm:mb-0">
            <h2 class="text-2xl font-medium font-display">@lang('Step') 2</h2>
            <p>@lang('Get up to date news about KS voter registration, elections, candidates and&nbsp;more.')</p>
        </div>
        <div class="sm:w-1/3 px-4">
            <h2 class="text-2xl font-medium font-display">@lang('Step') 3</h2>
            <p>@lang('Stay locally active and engaged. It couldn’t be&nbsp;easier!')</p>
        </div>
    </div>
</section>

<section class="px-8 py-16 sm:py-32 bg-red-200 relative">
    <div class="absolute inset-0 bg-center" style="background-image: url({{ asset('img/map.jpg') }});"></div>
    <div class="bg-white max-w-md mx-auto px-10 py-5 text-center rounded-lg shadow-lg relative z-10">
        <h2 class="text-3xl sm:text-4xl font-medium text-center font-display leading-tight mb-4">
            @lang('Available in Spanish')
        </h2>
        <p>@lang(':login to manage your language preferences!', ['login' => '<a class="text-link" href="'.route('subscriber.login').'">'.__('Log in').'</a>'])</p>
    </div>
</section>

<section class="max-w-5xl mx-auto py-10 sm:py-20 px-8">
    <div class="px-4">
        <div class="sm:flex items-center -mx-4">
            <div class="px-4 sm:w-1/2 mb-8 sm:mb-0 text-center">
                <a class="inline-block mb-3" href="https://www.kmuw.org/" target="_blank">
                    <img style="max-width: 190px" src="{{ asset('img/kmuw.png') }}" alt="KMUW logo">
                </a>
                <br>
                <a class="inline-block mb-3" href="https://devict.org/" target="_blank">
                    <img style="max-width: 190px" src="{{ asset('img/devict.png') }}" alt="devICT logo">
                </a>
                <br>
                <a class="inline-block" href="https://www.abcbilingualresources.com/" target="_blank">
                    <img style="max-width: 190px" src="{{ asset('img/ab-c-bilingual.png') }}" alt="AB&C Bilingual Resources logo">
                </a>
            </div>
            <div class="px-4 sm:w-1/2 text-center sm:text-left">
                <h2 class="text-3xl sm:text-4xl font-medium font-display leading-tight mb-4">
                    @lang('Brought to you by the&nbsp;community')
                </h2>
                <p>@lang('Vote Local is created and operated by local community organizations :kmuw, :devict, and :abc.', [
                    'kmuw' => '<a class="font-bold text-gray-600 hover:text-blue-500" href="https://www.kmuw.org" target="_blank">KMUW</a>',
                    'devict' => '<a class="font-bold text-gray-600 hover:text-blue-500" href="https://devict.org" target="_blank">devICT</a>',
                    'abc' => '<a class="font-bold text-gray-600 hover:text-blue-500" href="https://www.abcbilingualresources.com/" target="_blank">AB&C Bilingual Resources</a>'
                ])</p>
            </div>
        </div>
    </div>
    <hr class="border-t-2 my-10 sm:my-20">
    <div class="px-4">
        <div class="sm:flex items-center -mx-4">
            <div class="px-4 sm:w-1/2 mb-8 sm:mb-0">
                <h2 class="text-3xl sm:text-4xl font-medium font-display leading-tight mb-4">
                    @lang('Project Contributors')
                </h2>
                <p class="mb-4">@lang('These people have been involved in the creation and maintenance of the Vote Local platform.')</p>
                <p>@lang('Feel like helping out? Check out our list of') <a href="https://github.com/devict/votelocal/issues" class="font-bold text-gray-600 hover:text-blue-500">@lang('issues')</a> @lang('on our') <a href="https://github.com/devict/votelocal" class="font-bold text-gray-600 hover:text-blue-500">GitHub</a>.</p>
            </div>
            <div class="px-4 sm:w-1/2">
                @forelse($contributors as $contributor)
                    <a class="inline-flex items-center border border-gray-400 shadow rounded-full text-lg font-bold mb-4 mr-4 leading-tight hover:shadow-md" href="{{ $contributor->html_url }}">
                        <img class="w-8 h-8 rounded-full shadow-inner" src="{{ $contributor->avatar_url }}" alt="{{ $contributor->login }} avatar">
                        <span class="block mx-3">{{ $contributor->login }}</span>
                    </a>
                @empty
                    <div class="text-center">
                        <a class="btn" href="https://github.com/devict/votelocal/graphs/contributors">
                            View contributors on GitHub
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
