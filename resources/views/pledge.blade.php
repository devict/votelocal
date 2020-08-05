@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">
                    Vote the Plains
                    <span class="block text-base text-gray-600">Do you pledge to vote this November?</span>
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                <form class="mt-8" method="POST" action="{{ route('subscriber.login') }}">
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
                    <button class="btn text-xl font-bold mt-6 w-full">Pledge to Vote!</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
