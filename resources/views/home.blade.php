@extends('layouts.app')

@section('content')
<section class="relative">
    <svg class="absolute top-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 524" fill="none" preserveAspectRatio="xMaxYMax slice">
        <path d="M-2.29048e-05 6.10352e-05L0.000755813 524C0.000755813 524 208.527 439.984 382.411 428.445C556.189 416.913 626.874 463.72 859.963 399.76C1093.05 335.8 1280 128.084 1280 128.084L1280 5.08459e-06L798.707 2.61226e-05L463.791 4.07622e-05L-2.29048e-05 6.10352e-05Z" fill="#C7E6FA"/>
    </svg>
    <div class="relative">
        <div class="max-w-5xl mx-auto sm:flex justify-between md:items-center pt-8 md:pt-16">
            <div class="px-4 sm:px-8 sm:w-1/2">
                <h1 class="text-2xl font-medium leading-tight font-display mb-56 text-center sm:text-left sm:mb-4 sm:text-3xl sm:text-4xl">@lang('home.intro')</h1>
                <p class="text-lg leading-normal mb-8">@lang('home.tagline')</p>
                <div class="sm:pb-24">
                    <a class="btn bg-red-500 hover:bg-red-600 focus:bg-red-600 block sm:inline-block mb-4 sm:mr-3" href="{{ 'sms://+1' . env('TWILIO_FROM_NUMBER') . ';?&body=' . __('home.text_subscribe_keyword') }} ">
                        @lang('home.text_to')
                    </a>
                    <a class="btn block sm:inline-block" href="#steps">
                        @lang('home.learn_more')
                        @include('partials.icon', [
                            'width' => 16,
                            'height' => 16,
                            'name' => 'arrow-down-circle',
                            'class' => 'inline-block'
                        ])
                    </a>
                </div>
            </div>
            <div class="absolute top-0 mt-20 w-full sm:static sm:w-1/2 sm:mt-0 lg:mb-16">
                @include('partials.bubbles')
            </div>
        </div>
    </div>
</section>


<section id="steps" class="max-w-5xl mx-auto px-8 py-10 sm:py-20">
    <div class="sm:flex -mx-4">
        <div class="sm:w-1/3 px-4 mb-8 sm:mb-0">
            <h2 class="text-2xl font-medium font-display">Step 1</h2>
            <p>@lang('home.step_1')</p>
        </div>
        <div class="sm:w-1/3 px-4 mb-8 sm:mb-0">
            <h2 class="text-2xl font-medium font-display">Step 2</h2>
            <p>@lang('home.step_2')</p>
        </div>
        <div class="sm:w-1/3 px-4">
            <h2 class="text-2xl font-medium font-display">Step 3</h2>
            <p>@lang('home.step_3')</p>
        </div>
    </div>
</section>

<section class="px-8 py-16 sm:py-32 bg-red-200 relative">
    <div class="absolute inset-0" style="background-image: url({{ asset('img/map.jpg') }})"></div>
    <div class="bg-white max-w-md mx-auto px-10 py-5 text-center rounded-lg shadow-lg relative z-10">
        <h2 class="text-3xl sm:text-4xl font-medium text-center font-display leading-tight mb-4">
            @lang('home.locale_support_head')
        </h2>
        <p>@lang('home.locale_support_body', ['link' => 'tel:+1' . env('TWILIO_FROM_NUMBER')])</p>
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
                <a class="inline-block mb-3" href="http://devict.org/" target="_blank">
                    <img style="max-width: 190px" src="{{ asset('img/devict.png') }}" alt="devICT logo">
                </a>
                <br>
                <a class="inline-block" href="https://www.abcbilingualresources.com/" target="_blank">
                    <img style="max-width: 190px" src="{{ asset('img/ab-c-bilingual.png') }}" alt="AB&C Bilingual Resources logo">
                </a>
            </div>
            <div class="px-4 sm:w-1/2 text-center sm:text-left">
                <h2 class="text-3xl sm:text-4xl font-medium font-display leading-tight mb-4">
                    @lang('home.partners_head')
                </h2>
                <p>@lang('home.partners_body')</p>
            </div>
        </div>
    </div>
    <hr class="border-t-2 my-10 sm:my-20">
    <div class="px-4">
        <div class="sm:flex items-center -mx-4">
            <div class="px-4 sm:w-1/2 mb-8 sm:mb-0">
                <h2 class="text-3xl sm:text-4xl font-medium font-display leading-tight mb-4">
                    @lang('home.contributors_head')
                </h2>
                <p>@lang('home.contributors_body')</p>
            </div>
            <div class="px-4 sm:w-1/2">
                @forelse($contributors as $contributor)
                    <a class="inline-flex items-center border border-gray-400 shadow rounded-full text-lg font-bold mb-4 mr-4 leading-tight hover:shadow-md" href="{{ $contributor->html_url }}">
                        <img class="w-8 h-8 rounded-full shadow-inner" src="{{ $contributor->avatar_url }}" alt="{{ $contributor->login }} avatar">
                        <span class="block mx-3">{{ $contributor->login }}</span>
                    </a>
                @empty
                    <div class="text-center">
                        <a class="btn" href="https://github.com/devict/voteict/graphs/contributors">
                            View contributors on GitHub
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
