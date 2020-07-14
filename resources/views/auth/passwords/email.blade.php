@extends('layouts.base')

@section('content')
<div class="bg-gray-200 min-h-screen flex justify-center items-center sm:px-6 lg:px-8">
    <div class="w-full max-w-sm">
        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}"
            class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden"
        >
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">{{ __('Reset Password') }}</h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                @include('partials.flash')
                @csrf

                <div class="mt-6">
                    <x-text :label="__('E-Mail Address')" type="email" name="email" :value="old('email')" required autofocus />
                </div>
            </div>
            <div class="bg-gray-100 border-t border-gray-200 flex justify-end items-center px-4 py-4 sm:px-6">
                <button type="submit" class="btn">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
