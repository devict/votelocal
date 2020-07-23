@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <form action="{{ route('subscriber.login') }}" method="POST" class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">@lang('subscriber.welcome')</h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>
                @include('partials.flash')
                @csrf
                <div class="mt-6 space-y-4">
                    <x-text
                        type="tel"
                        :label="__('subscriber.login_start')"
                        name="number"
                        :value="old('number')"
                        autofocus
                        required
                        pattern=".{10}"
                    />
                </div>
            </div>
            <div class="bg-gray-100 border-t border-gray-200 flex justify-end items-center px-4 py-4 sm:px-6">
                <button class="btn">@lang('subscriber.login')</button>
            </div>
        </form>
    </div>
</main>
@endsection
