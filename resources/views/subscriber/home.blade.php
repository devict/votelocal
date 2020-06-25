@extends('layouts.app')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    Oh hey! {{ $subscriber->number }}
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    <tag-manager
        update-endpoint="{{ route('subscriber.updateTags', $subscriber) }}"
        v-bind:location-tags='{!! json_encode($locationTags) !!}'
        v-bind:topic-tags='{!! json_encode($topicTags) !!}'
        v-bind:current-tags='{!! json_encode($subscriber->tagIds()) !!}'>
    </tag-manager>
</div>
@endsection
