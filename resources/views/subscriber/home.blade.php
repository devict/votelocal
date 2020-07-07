@extends('layouts.app')

@section('content')
<main class="px-4 py-8 md:p-12">
    <div class="max-w-sm">
        <div class="flex">
            <div class="w-1/2">
                <h1 class="font-bold text-2xl">@lang('subscriber.welcome')</h1>
            </div>
            <div class="w-1/2 text-right py-2">
                <span class="font-light">{{ $subscriber->number }}</span>
            </div>
        </div>

        @if(!$subscriber->subscribed)
            <p class="text-lg">
                Your subscription is <span class="font-bold">not active</span>.
            </p>
            <form action="{{ route('subscriber.enable')}}" method="POST">
                @csrf <button class="btn mt-4 text-lg" type="submit">Sign back up!</submit>
            </form>
        @else
            <p class="text-lg mb-8">
                Your subscription is <span class="font-bold">active</span>.
            </p>

<div
    x-data="tagManager({
        updateEndpoint: '{{ route('subscriber.updateTags') }}',
        activeTags: {{ json_encode($subscriber->tagIds()) }}
    })"
    class="flex"
>
    <div class="w-1/2">
        <label class="font-bold">Locations</label>
        <ul>
            @foreach($locationTags as $tag)
                <li>
                    <label>
                        <input type="checkbox"
                            value="{{ $tag->id }}"
                            :disabled="loading"
                            @change="updateTags"
                            :checked="isChecked({{ $tag->id }})"
                        >
                        {{ $tag->name }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="w-1/2">
        <label class="font-bold">Topics</label>
        <ul>
            @foreach($topicTags as $tag)
                <li>
                    <label>
                        <input type="checkbox"
                            value="{{ $tag->id }}"
                            :disabled="loading"
                            @change="updateTags"
                            :checked="isChecked({{ $tag->id }})"
                        >
                        {{ $tag->name }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

            <hr class="mt-6">

            <form class="text-small py-4" action="{{ route('subscriber.disable')}}" method="POST">
                @csrf <button onclick="return confirm('Are you sure?')" class="hover:underline text-red-400" type="submit">Disable your subscription.</submit>
            </form>

        @endif
    </div>
</div>

@endsection
