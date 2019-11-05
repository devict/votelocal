@extends('layouts.base')

@section('content')
<div class="bg-gray-200 p-6 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-sm">
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}"
            class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden"
        >
            <div class="px-10 py-12">
                <h1 class="text-center font-bold text-3xl">{{ __('Welcome Back!') }}</h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>

                @include('partials.flash')

                @csrf

                @include('partials/fields/input', [
                    'label' => __('E-Mail Address'),
                    'type' => 'email',
                    'name' => 'email',
                    'value' => old('email'),
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

                @include('partials/fields/checkbox', [
                    'label' => __('Remember Me'),
                    'name' => 'remember',
                    'class' => 'mt-6',
                    'checked' => old('remember', 0)
                ])
            </div>
            <div
                class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center"
              >
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                <button type="submit" class="btn">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
