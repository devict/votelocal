@extends('layouts.app')

@section('content')
<form action="{{ route('elected-officials.lookup') }}" method="post" class="flex justify-center mx-auto w-1/3">
    @csrf
    <input type="text" name="address" id="address" class="border border-black m-4">
    <button type="submit">Submit</button>
</form>

@if (isset($data))
<h3 class="text-center text-xl">Showing results for address:</h3>
@php
    $address = $data->normalizedInput
@endphp
<p class="text-center">{{ $address->line1 }}</p>
<p class="text-center">{{ "{$address->city}, {$address->state} {$address->zip}" }}</p>
<div class="flex flex-wrap justify-between mx-auto w-2/3">
    @foreach ($data->offices as $office)
    @php $official = $data->officials[$office->officialIndices[0]] @endphp
    <div class="flex justify-between mb-8 w-2/3 bg-white max-w-md mx-auto px-6 py-6 rounded-lg shadow-lg relative z-10">
        @if (isset($official->photoUrl))
        <div class="w-1/4">
            <img src="{{ $official->photoUrl }}" alt="{{ $official->name }}">
        </div>
        @endif
        <div class="px-4 w-3/4">
            <p class="font-bold">{{ $office->name }}</p>
            <p>{{ $official->name }}</p>
            <p>{{ $official->party }}</p>
            {{-- <p><a href="tel:{{ $official->"></a></p> --}}
            @if (isset($official->phones))
                @foreach ($official->phones as $phone)
                    <p class="italic mt-6 hover:text-blue-500"><a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                @endforeach
            @endif

            @if (isset($official->urls) && count($official->urls))
                @foreach ($official->urls as $url)
                    <p class="italic hover:text-blue-500"><a href="tel:{{ $url }}">{{ $url }}</a></p>
                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection