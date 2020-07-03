@extends('layouts.app')

@section('content')
<form action="{{ route('elected-officials.lookup') }}" method="post" class="flex justify-center mx-auto w-1/3">
    @csrf
    <input type="text" name="address" id="address" class="border border-black m-4">
    <button type="submit">Submit</button>
</form>

@if (isset($data))
<div class="flex flex-wrap justify-between mx-auto w-2/3">
    @foreach ($data->offices as $office)
    @php $official = $data->officials[$office->officialIndices[0]] @endphp
    <div class="flex mb-8 w-1/2 bg-white max-w-md mx-auto px-10 py-5 rounded-lg shadow-lg relative z-10">
        @if (isset($official->photoUrl))
        <img src="{{ $official->photoUrl }}" alt="{{ $official->name }}" height="100" width="100" class="mx-4">
        @endif
        <div>
            <p class="font-bold">{{ $office->name }}</p>
            <p>{{ $official->name }}</p>
            <p>{{ $official->party }}</p>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection