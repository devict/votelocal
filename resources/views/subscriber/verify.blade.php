@extends('layouts.admin')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    Sign Up
</h1>

<div class="bg-white rounded shadow overflow-hidden max-w-sm">
    @include ('partials.flash')

    <form action="{{ route('subscriber.verify') }}" method="POST">
        <input type="hiden" name="number" value="{{ session('number' )}}">
        <div class="p-8">
            @csrf
            @include('partials/fields/input', [
                'label' => __('subscriber.verify'),
                'name' => 'password',
                'value' => '',
                'attributes' => [ 'required' => true ],
            ])

            <button class="btn">@lang('subscriber.login')</button>
        </div>
    </form>
</div>
@endsection
