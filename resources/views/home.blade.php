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
                <svg class="bubbles max-w-full h-auto mx-auto mx-auto w-64 sm:w-auto" style="max-height: 516px; padding-bottom: 6%;" viewBox="0 0 430 323"  fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g class="b1"><path fill-rule="evenodd" clip-rule="evenodd" d="M362.441 103.013H221.62c-9.132 0-17.891 3.673-24.349 10.209-6.458 6.537-10.086 15.403-10.086 24.647v46.596c0 9.245 3.628 18.11 10.086 24.647 6.458 6.537 15.217 10.209 24.349 10.209h140.821c8.651.004 16.991-3.268 23.38-9.173l.362.367C397.42 221.889 415 219.321 415 219.321c-20.48-23.115-17.761-48.248-17.761-48.248l-.181-33.204c-.067-9.255-3.742-18.109-10.224-24.637-6.483-6.527-15.249-10.2-24.393-10.219z" fill="#047A9F" opacity=".9" filter="url(#filter0_dd)"/></g>
                    <g class="b2"><path fill-rule="evenodd" clip-rule="evenodd" d="M314.759 181.159H173.938c-9.132 0-17.891 3.672-24.349 10.209-6.458 6.537-10.086 15.402-10.086 24.647v46.596c0 9.244 3.628 18.11 10.086 24.647 6.458 6.536 15.217 10.209 24.349 10.209h140.821c8.651.003 16.991-3.269 23.38-9.173l.362.367c11.237 11.374 28.817 8.806 28.817 8.806-20.48-23.115-17.761-48.248-17.761-48.248l-.182-33.204c-.066-9.256-3.741-18.11-10.223-24.637-6.483-6.527-15.249-10.2-24.393-10.219z" fill="#F9587C" opacity=".6" filter="url(#filter1_dd)"/></g>
                    <g class="b3"><path fill-rule="evenodd" clip-rule="evenodd" d="M76.42 63.278h164.564a40.363 40.363 0 0 1 28.455 11.717 39.884 39.884 0 0 1 11.786 28.288v53.48a39.886 39.886 0 0 1-11.786 28.288 40.364 40.364 0 0 1-28.455 11.717H76.42A40.629 40.629 0 0 1 49.1 186.24l-.424.421C35.545 199.715 15 196.768 15 196.768c23.933-26.53 20.756-55.375 20.756-55.375l.212-38.11a40.183 40.183 0 0 1 11.947-28.276A40.66 40.66 0 0 1 76.42 63.278z" fill="#58B9E9" opacity=".7" filter="url(#filter2_dd)"/></g>
                    <g class="b4"><path fill-rule="evenodd" clip-rule="evenodd" d="M109.945 148.046h119.534a29.186 29.186 0 0 1 20.668 8.585 29.351 29.351 0 0 1 8.562 20.726v39.183c0 7.774-3.08 15.229-8.562 20.726a29.186 29.186 0 0 1-20.668 8.585H109.945a29.37 29.37 0 0 1-19.846-7.714l-.307.309c-9.538 9.564-24.46 7.405-24.46 7.405 17.383-19.438 15.075-40.572 15.075-40.572l.154-27.922a29.566 29.566 0 0 1 8.678-20.717 29.403 29.403 0 0 1 20.706-8.594z" fill="#EE215A" opacity=".9" filter="url(#filter3_dd)"/></g>
                    <g class="b5"><path fill-rule="evenodd" clip-rule="evenodd" d="M206.634 5h119.534a29.187 29.187 0 0 1 20.668 8.585 29.35 29.35 0 0 1 8.561 20.725v39.184a29.35 29.35 0 0 1-8.561 20.725 29.187 29.187 0 0 1-20.668 8.585H206.634a29.37 29.37 0 0 1-19.846-7.713l-.307.309c-9.538 9.564-24.461 7.404-24.461 7.404 17.384-19.437 15.076-40.572 15.076-40.572l.154-27.922a29.57 29.57 0 0 1 8.678-20.717A29.405 29.405 0 0 1 206.634 5z" fill="#BB0646" opacity=".8" filter="url(#filter4_dd)"/></g>
                    <defs>
                    <filter id="filter0_dd" x="172.185" y="98.013" width="257.815" height="146.556" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="3"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="7.5"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                        <feBlend in2="effect1_dropShadow" result="effect2_dropShadow"/>
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
                    </filter>
                    <filter id="filter1_dd" x="124.503" y="176.159" width="257.815" height="146.556" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="3"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="7.5"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                        <feBlend in2="effect1_dropShadow" result="effect2_dropShadow"/>
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
                    </filter>
                    <filter id="filter2_dd" x="0" y="58.278" width="296.225" height="163.775" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="3"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="7.5"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                        <feBlend in2="effect1_dropShadow" result="effect2_dropShadow"/>
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
                    </filter>
                    <filter id="filter3_dd" x="50.331" y="143.046" width="223.377" height="128.013" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="3"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="7.5"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                        <feBlend in2="effect1_dropShadow" result="effect2_dropShadow"/>
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
                    </filter>
                    <filter id="filter4_dd" x="147.02" y="0" width="223.377" height="128.013" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="3"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feColorMatrix in="SourceAlpha" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="7.5"/>
                        <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                        <feBlend in2="effect1_dropShadow" result="effect2_dropShadow"/>
                        <feBlend in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
                    </filter>
                    </defs>
                </svg>
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
            <div class="px-4 sm:w-1/2 mb-8 sm:mb-0">
                <img class="mx-auto mb-6" style="max-width: 190px" src="{{ asset('img/kmuw.png') }}" alt="KMUW logo">
                <img class="mx-auto" style="max-width: 190px" src="{{ asset('img/devict.png') }}" alt="devICT logo">
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
