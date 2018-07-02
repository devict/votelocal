@extends('layouts.app')

@section('content')

<div class="container home-feature">
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <h1 class="text-center">
                @lang('home.tagline')
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid bg-white">
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <h1 class="text-center">@lang('home.text_subscribe_cta')</h1>
            <h2 class="text-center">
                <!-- TODO: make this a vcard link -->
                @lang('home.add_to_contacts_cta', ['link' => '#'])
            </h2>
        </div>
    </div>
</div>

@endsection
