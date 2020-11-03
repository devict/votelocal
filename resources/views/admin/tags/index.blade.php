@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Tags</h1>
    <a href="{{ route('tags.admin.new') }}" class="btn">
        <span>Create</span> <span class="hidden md:inline">Tag</span>
    </a>
</div>

@include('partials.flash')

<div class="bg-white rounded shadow overflow-x-auto">
    <header class="bg-gray-100 px-4 py-4 sm:px-6">
        <h2 class="text-xl font-bold">Locations</h2>
    </header>
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-4 py-4 sm:px-6">Name</th>
                <th class="px-4 py-4 sm:px-6">Subscriber Default</th>
                <th class="px-4 py-4 sm:px-6">Message Default</th>
                <th class="px-4 py-4 sm:px-6">Subscribers</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locationTags as $tag)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t w-1/2">
                        <a
                            class="flex items-center px-4 py-4 sm:px-6"
                            href="{{ route('tags.admin.edit', $tag) }}"
                            tabindex="-1"
                        >
                            {{ $tag->name }}
                        </a>
                    </td>
                    <td class="border-t px-4 py-4 sm:px-6">
                        @if ($tag->subscriber_default)
                            <x-icon-checkmark width="24" />
                        @else
                            <div class="w-8 text-center">—</div>
                        @endif
                    </td>
                    <td class="border-t px-4 py-4 sm:px-6">
                        @if ($tag->message_default)
                            <x-icon-checkmark width="24" />
                        @else
                            <div class="w-8 text-center">—</div>
                        @endif
                    </td>
                    <td class="border-t px-4 py-4 sm:px-6">
                        {{ $tag->subscribers_count }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <header class="bg-gray-100 px-4 py-4 sm:px-6 border-t">
        <h2 class="text-xl font-bold">Topics</h2>
    </header>
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-4 py-4 sm:px-6">Name</th>
                <th class="px-4 py-4 sm:px-6">Subscriber Default</th>
                <th class="px-4 py-4 sm:px-6">Message Default</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topicTags as $tag)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t w-1/2">
                        <a
                            class="px-4 py-4 sm:px-6 flex items-center"
                            href="{{ route('tags.admin.edit', $tag) }}"
                            tabindex="-1"
                        >
                            {{ $tag->name }}
                        </a>
                    </td>
                    <td class="border-t px-4 py-4 sm:px-6">
                        @if ($tag->subscriber_default)
                            <x-icon-checkmark width="24" />
                        @else
                            <div class="w-8 text-center">—</div>
                        @endif
                    </td>
                    <td class="border-t px-4 py-4 sm:px-6">
                        @if ($tag->message_default)
                            <x-icon-checkmark width="24" />
                        @else
                            <div class="w-8 text-center">—</div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
