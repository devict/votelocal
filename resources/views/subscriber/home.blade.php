@extends('layouts.app')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    Oh hey! {{ $subscriber->number }}
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    <tag-manager
        update-endpoint="{{ route('subscriber.updateTags', $subscriber) }}"
        v-bind:tags='{!! json_encode($tags) !!}'
        v-bind:current-tags='{!! json_encode($subscriber->tagIds()) !!}'>
    </tag-manager>
</div>
@endsection
