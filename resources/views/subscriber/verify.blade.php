@extends('layouts.app')

@section('content')
<main class="px-4 py-8 md:p-12">
    <h1 class="font-bold text-2xl">
        @lang('subscriber.almost_there')
    </h1>
    <h2 class="mb-6 text-xl">
        @lang('subscriber.verify')
    </h2>

    <div class="bg-white overflow-hidden max-w-sm">
        <form action="{{ route('subscriber.verify') }}" method="POST">
            <input type="hiden" name="number" value="{{ session('number' )}}">
            @csrf
            @include('partials/fields/input', [
                'label' => '',
                'name' => 'password',
                'value' => '',
                'attributes' => [ 'required' => true ],
            ])

            <button class="btn mt-4 text-lg">@lang('subscriber.submit')</button>
        </form>
    </div>
</main>
@endsection
