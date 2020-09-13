@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-semibold text-3xl">
                    <img class="h-24 mx-auto" src="{{ asset('img/votetheplains.png') }}" alt="Vote The Plains">
                    <span class="block text-base pt-4 text-gray-600">@lang('Do you pledge to vote this November?')</span>
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                <form class="mt-8" method="POST" action="{{ route('subscriber.login') }}?pledge=1">
                    @csrf
                    @if ($referred_by)
                        <input type="hidden" name="referred_by" value="{{ $referred_by }}">
                    @endif
                    <x-text class="mt-4 rounded-b-none relative focus:z-10" autofocus name="name" required placeholder="Your Name" />
                    <x-text
                        type="tel"
                        class="-mt-px rounded-t-none relative focus:z-10"
                        name="number"
                        :value="old('number')"
                        required
                        placeholder="Phone Number"
                        pattern=".{10}"
                    />
                    <div class="text-gray-600 mt-4">
                        <x-checkbox
                            :label="__('Don\'t display my name publicly')"
                            name="hide_from_pledge_board"
                        />
                    </div>
                    <button class="btn text-xl mt-6 w-full">@lang('Pledge to Vote!')</button>
                    <p class="text-sm text-gray-600 text-center mt-4 px-4">
                        @lang('You will also receive important election reminders, opt out at any time.')
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

<section class="my-16 sm:px-6 lg:px-8">
     <h2 class="text-center font-bold text-xl mt-4 text-gray-600">
        @lang('Brought to you by the Community')
    </h2>
    <div class="max-w-md lg:max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <a class="block h-16 opacity-75 hover:opacity-100" href="https://wyoungpros.com">
                    <img class="h-16" src="{{ asset('img/w-young-pros.png')}}" alt="@lang('W Young Pros')">
                </a>
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <a class="block h-16 opacity-75 hover:opacity-100" href="https://kmuw.org">
                    <img class="h-16" src="{{ asset('img/kmuw.png')}}" alt="@lang('KMUW')">
                </a>
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <a class="block h-16 opacity-75 hover:opacity-100" href="https://devict.org">
                    <img class="h-16" src="{{ asset('img/devict.png')}}" alt="@lang('devICT')">
                </a>
            </div>
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <a class="block h-16 opacity-75 hover:opacity-100" href="https://www.abcbilingualresources.com">
                    <img class="h-16" src="{{ asset('img/ab-c-bilingual.png')}}" alt="@lang('AB&C Bilingual Resources')">
                </a>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
