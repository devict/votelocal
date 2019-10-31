@extends('layouts.app')

@section('content')

<div class="container home-feature">
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <img src="{{ asset('img/logo.svg') }}" title="Vote ICT">
            <h1 class="text-center home--tagline">
                @lang('home.tagline')
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid bg-white">
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <h1 class="text-center">
                @lang('home.text_subscribe_cta', ['link' => 'sms://+1' . env('TWILIO_FROM_NUMBER') . ';?&body=' . __('home.text_subscribe_keyword')])
            </h1>
            <h2 class="text-center">
                @lang('home.add_to_contacts_cta', ['link' => 'tel:+1' . env('TWILIO_FROM_NUMBER')])
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <h1 class="text-center">
                <strong>@lang('home.locale_support_head')</strong>
            </h1>
            <h4 class="text-center">
                @lang('home.locale_support_body', ['link' => 'tel:+1' . env('TWILIO_FROM_NUMBER')])
            </h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 my-5">
            <h2 class="text-center">@lang('home.partners_head')</h2>
            <p class="text-center">
                @lang('home.partners_body')
            </p>
        </div>
    </div>
</div>

@endsection
