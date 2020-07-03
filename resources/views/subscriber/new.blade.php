@extends('layouts.app')

@section('content')
<main class="px-4 py-8 md:p-12">
    <h1 class="font-bold text-2xl">
        @lang('subscriber.welcome')
    </h1>
    <h2 class="mb-6 text-xl">
        @lang('subscriber.login_start')
    </h2>

    <div class="bg-white overflow-hidden max-w-sm">
        <form action="{{ route('subscriber.login') }}" method="POST">
            @csrf
            @include('partials/fields/input', [
                'label' => '',
                'name' => 'number',
                'type' => 'number',
                'value' => '',
                'attributes' => [ 'required' => true ],
            ])

            <button class="btn mt-4 text-lg">@lang('subscriber.login')</button>
        </form>
    </div>
</main>
@endsection
