@extends('layouts.app')

@section('content')
{{-- <elected-official-lookup /> --}}
<form action="{{ route('elected-officials.lookup') }}" method="post">
    @csrf
    <input type="text" name="address" id="address" class="border border-black m-4">
    <button type="submit">Submit</button>
</form>

@if (isset($data))
    {{-- {{ json_encode($data) }} --}}
    @foreach ($data->offices as $office)
    <div class="m-2">
        <p class="font-bold">{{ $office->name }}</p>
        <p>{{ $data->officials[$office->officialIndices[0]]->name }}</p>
    </div>
    @endforeach
@endif
@endsection