@extends('layouts.app')

@section('content')

<header>
    <div class="max-w-5xl mx-auto px-4 flex justify-between sm:px-8 sm:items-center pt-8 md:pt-16">
        <div class="mr-auto sm:w-1/2">
            <h1 class="text-2xl font-medium leading-tight font-display sm:text-4xl">@lang('Pledge Progress')</h1>
            <p class="text-lg leading-normal">@lang('Track our pledge totals & the impact that our top pledgers have made.')</p>
        </div>
        <div class="flex-none mr-4 w-16 sm:w-32 md:w-64 sm:mr-0">
            <img src="{{ asset('img/votetheplains.png') }}" alt="Vote the Plains logo" />
        </div>
    </div>
</header>

<section class="bg-white relative">
    <div class="bg-gray-200 absolute bottom-0 left-0 right-0 h-1/2"></div>
    <div class="max-w-5xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
        <div class="relative border border-gray-200 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-6 sm:p-8">
                <h2 class="text-2xl font-medium font-display">@lang('Help us reach our goal!')</h2>
                <p class="mt-1">@lang('First, :pledge, then spread the word.', ['pledge' => '<a class="text-link" href="'.route('pledge').'">'.__('pledge to vote this November').'</a>'])</p>
                <div class="mt-6 shadow-inner w-full bg-red-100 mt-4 rounded-md overflow-hidden relative px-4 py-3">
                    <div class="bg-red-400 absolute left-0 top-0 bottom-0" style="width: {{ $pledgePercent }}%"></div>
                    <div class="relative leading-none text-xl text-center text-red-900 whitespace-no-wrap">
                        @lang('<strong>:count</strong> of <strong>:goal</strong> pledges!', ['count' => $pledgeCount, 'goal' => $pledgeGoal])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-gray-200">
    <div class="max-w-5xl mx-auto pt-5 px-8 pb-10 sm:pb-20">
        <h2 class="text-center text-3xl sm:text-4xl font-medium font-display leading-tight">@lang('Pledge Leaderboard')</h2>
        <div class="mt-4 mx-auto text-center max-w-xl">
            <p>@lang('Claim the top of the leaderboard by :pledge and referring your friends using your unique referral link', ['pledge' => '<a class="text-link" href="'.route('pledge').'">'.__('pledging to vote this November').'</a>']).</p>
        </div>
        <div class="mt-6 bg-white rounded-lg shadow-lg overflow-hidden">
            <ol class="divide-y divde-gray-200">
                @foreach($subsForLeaderboard as $sub)
                    <li class="flex justify-between p-4 px-5 sm:px-6">
                        <div class="flex-1 flex space-x-3">
                            @if ($loop->iteration === 1)
                                <x-icon-award width="20" class="w-5 h-5 text-blue-600" />
                            @elseif ($loop->iteration === 2)
                                <x-icon-award width="20" class="w-5 h-5 text-blue-400" />
                            @elseif ($loop->iteration === 3)
                                <x-icon-award width="20" class="w-5 h-5 text-gray-500" />
                            @else
                                <div aria-hidden class="text-gray-500 text-center" style="min-width: 20px;">{{ $loop->iteration }}</div>
                            @endif
                            <div class="font-semibold">{{ $sub->name }}</div>
                        </div>
                        @if ($loop->iteration <= 10 && $sub->referrals > 0)
                            <div class="text-gray-600"><strong>{{ $sub->referrals }}</strong> @lang('referrals')</div>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
@endsection
