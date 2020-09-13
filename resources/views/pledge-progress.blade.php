@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">
                    <img src="{{ asset('img/votetheplains.png') }}" alt="Vote The Plains">
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                <div class="shadow w-full bg-gray-400 mt-4">
                    <div class="bg-blue-400 text-xs leading-none p-2 text-xl font-bold text-center text-white" style="width: {{ $pledgePercent }}%">
                        {{ $pledgeCount }}&nbsp;/&nbsp;{{ $pledgeGoal }}&nbsp;pledges!
                    </div>
                </div>

                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                <h2 class="text-2xl mt-4">Pledge Leaderboard</h2>
                <ul>
                    @foreach($subsForLeaderboard as $sub)
                        <li>{{ $sub->name }} ({{ $sub->numPledges() }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
