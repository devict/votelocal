@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <form action="{{ route('subscriber.verify') }}" method="POST" class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">

                @if(session('fromPledge'))
                    <h1 class="text-center font-bold text-3xl">
                        <img src="{{ asset('img/votetheplains.png') }}" alt="Vote The Plains">
                    </h1>
                    <div class="mx-auto mt-6 w-24 border-b-2"></div>
                @endif

                <h1 class="text-center font-bold text-3xl mt-4">
                    @lang('Almost there!')
                    @if(session('fromPledge'))
                        <span class="block text-base text-gray-600">@lang('You\'re a true Voter of the Plains')</span>
                    @endif
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                @csrf
                <input type="hidden" name="number" value="{{ session('number' )}}">
                <div class="mt-6 space-y-4">
                    <x-text :label="__('Enter the code you received below.')" name="password" inputmode="numeric" required autofocus autocomplete="off" />
                </div>
            </div>
            <div class="bg-gray-100 border-t border-gray-200 flex justify-end items-center px-4 py-4 sm:px-6">
                <button class="btn">@lang('Submit')</button>
            </div>
        </form>
    </div>
</main>
@endsection
