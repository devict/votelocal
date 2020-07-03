@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Tags</h1>
    <a href="{{ route('tags.admin.new') }}" class="btn">
        <span>Create</span> <span class="hidden md:inline">Tag</span>
    </a>
</div>

@include('partials.flash')

<div class="bg-white rounded shadow overflow-x-auto max-w-lg">
    <h1 class="text-2xl mt-6 mx-6 font-bold">Locations</h1>
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Subscriber Default</th>
                <th class="px-6 pt-6 pb-4">Message Default</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locationTags as $tag)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t w-1/2">
                        <a
                            class="px-6 py-4 flex items-center"
                            href="{{ route('tags.admin.edit', $tag) }}"
                            tabindex="-1"
                        >
                            {{ $tag->name }}
                        </a>
                    </td>
                    <td class="border-t px-6">
                        @if ($tag->subscriber_default)
                            X
                        @endif
                    </td>
                    <td class="border-t px-6">
                        @if ($tag->message_default)
                            X
                        @endif
                    </td>
                    <td class="border-t px-6">
                        <a href="{{ route('tags.admin.destroy', $tag) }}" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="my-8">

    <h1 class="text-2xl mt-6 mx-6 font-bold">Topics</h1>
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Subscriber Default</th>
                <th class="px-6 pt-6 pb-4">Message Default</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topicTags as $tag)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t w-1/2">
                        <a
                            class="px-6 py-4 flex items-center"
                            href="{{ route('tags.admin.edit', $tag) }}"
                            tabindex="-1"
                        >
                            {{ $tag->name }}
                        </a>
                    </td>
                    <td class="border-t px-6">
                        @if ($tag->subscriber_default)
                            X
                        @endif
                    </td>
                    <td class="border-t w-px px-6">
                        @if ($tag->message_default)
                            X
                        @endif
                    </td>
                    <td class="border-t px-6">
                        <a href="{{ route('tags.admin.destroy', $tag) }}" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
