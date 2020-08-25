@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">
                    <img src="{{ asset('img/votetheplains.png') }}" alt="Vote The Plains">
                    <span class="block text-base pt-8 text-gray-600">Do you pledge to vote this November?</span>
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                <form class="mt-8" method="POST" action="{{ route('subscriber.login') }}?pledge=1">
                    @csrf
                    @if ($referred_by)
                        <input type="hidden" name="referred_by" value="{{ $referred_by }}">
                    @endif
                    <x-text class="mt-4" autofocus name="name" required placeholder="Your Name" />
                    <x-text
                        type="tel"
                        name="number"
                        :value="old('number')"
                        required
                        placeholder="Phone Number"
                        pattern=".{10}"
                    />
                    <div class="text-xs text-gray-600">
                        <x-checkbox
                            :label="__('Don\'t display my name publicly')"
                            name="hide_from_pledge_board"
                        />
                    </div>
                    <button class="btn text-xl font-bold mt-6 w-full">@lang('Pledge to Vote!')</button>
					<p class="text-sm text-gray-600 text-center mt-2 px-4">
						@lang('You will also receive important election reminders, opt out at any time.')
					</p>
                </form>

                <div class="mx-auto mt-6 w-24 border-b-2"></div>

            </div>
        </div>
    </div>
</main>

<main class="my-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-xl mt-4">
                    @lang('Brought to you by the Community')
                </h1>
                <div>
                    <a href="https://wyoungpros.com">
                        <img src="{{ asset('img/w-young-pros.png')}}" alt="@lang('W Young Pros')">
                    </a>
                    <a href="https://kmuw.org">
                        <img src="{{ asset('img/kmuw.png')}}" alt="@lang('KMUW')">
                    </a>
                    <a href="https://devict.org">
                        <img src="{{ asset('img/devict.png')}}" alt="@lang('devICT')">
                    </a>
                    <a href="https://www.abcbilingualresources.com">
                        <img src="{{ asset('img/ab-c-bilingual.png')}}" alt="@lang('AB&C Bilingual Resources')">
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
