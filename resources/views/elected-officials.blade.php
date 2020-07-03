@extends('layouts.app')

@section('content')
<form action="{{ route('elected-officials.lookup') }}" method="post">
    @csrf
    <input type="text" name="address" id="address" class="border border-black m-4">
    <button type="submit">Submit</button>
</form>

@if (isset($data))
<div class="flex flex-wrap justify-center mx-auto w-2/3">
    @foreach ($data->offices as $office)
    @php $official = $data->officials[$office->officialIndices[0]] @endphp
    <div class="m-8 flex">
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