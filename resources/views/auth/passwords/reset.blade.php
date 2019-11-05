@extends('layouts.base')

@section('content')
<div class="bg-gray-200 p-6 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-sm">
        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}"
            class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden"
        >
            @csrf
            <div class="px-10 py-12">
                <h1 class="text-center font-bold text-3xl">{{ __('Reset Password') }}</h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                @include('partials/fields/input', [
                    'label' => '',
                    'type' => 'hidden',
                    'name' => 'token',
                    'value' => $token,
                    'class' => '',
                ])

                @include('partials/fields/input', [
                    'label' => __('E-Mail Address'),
                    'type' => 'email',
                    'name' => 'email',
                    'value' => $email ?? old('email'),
                    'class' => 'mt-6',
                    'attributes' => ['required' => true, 'autofocus' => true]
                ])

                @include('partials/fields/input', [
                    'type' => 'password',
                    'label' => __('Password'),
                    'name' => 'password',
                    'value' => '',
                    'class' => 'mt-6',
                    'attributes' => ['required' => true]
                ])

                @include('partials/fields/input', [
                    'type' => 'password',
                    'label' => __('Confirm Password'),
                    'name' => 'password_confirmation',
                    'value' => '',
                    'class' => 'mt-6',
                    'attributes' => ['required' => true]
                ])

            </div>
            <div
                class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
            >
                <button type="submit" class="btn">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
