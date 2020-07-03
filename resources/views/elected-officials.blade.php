@extends('layouts.app')

@section('content')
<header class="mx-auto my-8 w-5/6 md:w-1/2">
    <p>@lang('resources.elected_officials.page_intro')</p>
    <p class="mt-6">Enter your address below to search.</p>
</header>

<aside class="mx-auto w-5/6 md:w-1/2">
    <p class="text-right text-xs">Powered by Google Civic Information API</p>
</aside>

<form action="{{ route('elected-officials.lookup') }}" method="post" class="flex flex-col md:flex-row items-center justify-center mt-6 mx-auto w-5/6 md:w-1/3">
    @csrf
    <div>
        <input type="text" name="address" id="address" class="border border-black p-2">
        @if($errors->has('address'))
        <p class="mt-2 text-red-500">{{ $errors->first('address') }}</p>
        @endif
    </div>
    <button type="submit" class="btn block mt-4 md:mt-0 md:ml-8 sm:inline-block">Submit</button>
</form>

@if (isset($error))
    @foreach ($error->errors as $errorMessage)
        @if ($errorMessage->reason == 'parseError')
            <p class="mt-6 text-center text-red-500">I had some trouble reading that address.</p>
            <p class="text-center text-red-500">Make sure to use the format "&lt;House Number&gt; &lt;Street&gt; &lt;City&gt; &lt;State&gt; &lt;Zip Code&gt;</p>
            <p class="text-center text-xs">Commas are not necessary</p>
        @endif
    @endforeach
@endif

@if (isset($data))
<h3 class="font-bold font-display font-medium mt-12 text-center text-2xl">Showing results for address:</h3>

@php
    $address = $data->normalizedInput
@endphp

<p class="text-center">{{ $address->line1 }}</p>
<p class="text-center">{{ "{$address->city}, {$address->state} {$address->zip}" }}</p>

<div class="flex flex-wrap justify-between mt-12 mx-auto w-full md:w-2/3">
    @foreach ($data->offices as $office)
    @php $official = $data->officials[$office->officialIndices[0]] @endphp
    @if (strpos($official->party, 'Republican') !== false || $official->party === 'Republican Party')
    <div class="bg-red-100 flex flex-col md:flex-row justify-between mb-8 w-5/6 md:w-2/3 max-w-md mx-auto px-6 py-6 rounded-lg shadow-lg relative z-10">
    @elseif (strpos($official->party, 'Democratic') !== false || $official->party === 'Democratic Party')
    <div class="bg-blue-100 flex flex-col md:flex-row justify-between mb-8 w-5/6 md:w-2/3 max-w-md mx-auto px-6 py-6 rounded-lg shadow-lg relative z-10">
    @else
    <div class="bg-white flex flex-col md:flex-row justify-between mb-8 w-5/6 md:w-2/3 max-w-md mx-auto px-6 py-6 rounded-lg shadow-lg relative z-10">
    @endif
        @if (isset($official->photoUrl))
        <div class="mx-auto md:mx-0 mb-4 md:mb-0 w-1/4">
            <img src="{{ $official->photoUrl }}" alt="{{ $official->name }}">
        </div>
        @endif
        <div class="px-4 w-3/4">
            <p class="font-bold font-display">{{ $office->name }}</p>
            <p>{{ $official->name }}</p>
            <p class="text-sm">{{ $official->party }}</p>
            @if (isset($official->phones))
                @foreach ($official->phones as $phone)
                    <p class="italic mt-6 text-sm hover:text-blue-500"><a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                @endforeach
            @endif

            @if (isset($official->urls) && count($official->urls))
                @foreach ($official->urls as $url)
                    <p class="italic text-sm hover:text-blue-500"><a href="{{ $url }}">Official Website</a></p>
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection