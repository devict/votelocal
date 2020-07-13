@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
    <header class="mr-auto sm:w-2/3">
        <h1 class="text-2xl font-medium leading-tight font-display sm:text-4xl">@lang('resources.elected_officials.name')</h1>
        <p class="text-lg leading-normal">@lang('resources.elected_officials.page_intro')</p>
    </header>
</div>


<section class="max-w-5xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8 space-y-8">
    <form action="{{ route('elected-officials.lookup') }}" method="post">
        @csrf
        <label for="address">Your full address</label>
        <div class="sm:flex mt-1">
            <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="123 Fake St. Wichita KS 67202" class="form-input w-full flex-1 flex-shink-0 sm:rounded-r-none sm:text-lg sm:p-4" autofocus>
            <button type="submit" class="btn sm:rounded-l-none block w-full mt-3 sm:w-auto sm:text-lg sm:mt-0">
                <x-icon-search width="20" class="-ml-1 mr-1 inline-block sm:w-6" />
                Search
            </button>
        </div>
        <aside class="text-center">
            <small class="text-gray-500">Powered by Google Civic Information API</small>
        </aside>
    </form>
    @error('address')
        <div role="alert" class="text-red-800 my-8">{{ $message }}</div>
    @enderror
    @if (isset($data))
        <header>
            <h2 class="font-bold font-display font-medium text-center text-2xl">Elected officials for:</h2>

            @php $address = $data->normalizedInput; @endphp
            <p class="text-center">{{ $address->line1 }}</p>
            <p class="text-center">{{ $address->city }}, {{ $address->state }} {{ $address->zip }}</p>
        </header>

        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($data->offices as $office)
                @php
                    $official = $data->officials[$office->officialIndices[0]];
                    $color = 'gray';
                    if (strpos($official->party, 'Republican') !== false) {
                        $color = 'red';
                    } elseif (strpos($official->party, 'Democratic') !== false) {
                        $color = 'blue';
                    }
                @endphp
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow">
                    <div class="flex-1 flex flex-col p-8">
                        <div class="relative w-24 h-24 flex-shrink-0 mx-auto rounded-full overflow-hidden">
                            <img class="bg-black block w-full" src="{{ isset($official->photoUrl) ? $official->photoUrl : '/img/anonymous.png' }}" alt="{{ $official->name }}">
                        </div>
                        <h3 class="mt-6 text-gray-900 text-sm leading-5 font-medium">{{ $official->name }}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dt class="sr-only">Office</dt>
                            <dd class="text-gray-600 text-sm leading-5">{{ $office->name }}</dd>
                            <dt class="sr-only">Party affiliation</dt>
                            <dd class="mt-3">
                                <span class="px-2 py-1 text-{{ $color }}-800 text-xs leading-4 font-medium bg-{{ $color }}-200 rounded-full">
                                    {{ $official->party }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="-mt-px flex">
                            @if (isset($official->urls) && count($official->urls))
                                <div class="w-0 flex-1 flex border-r border-gray-200">
                                    <a href="{{ $official->urls[0] }}" class="group relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-red-500 focus:outline-none focus:border-red-300 focus:z-10 transition ease-in-out duration-150">
                                        <x-icon-globe-2 class="w-5 h-5 text-gray-500 group-hover:text-red-500" />
                                        <span class="ml-2">Website</span>
                                    </a>
                                </div>
                            @endif
                            @if (isset($official->phones) && count($official->phones))
                                <div class="-ml-px w-0 flex-1 flex">
                                    <a href="tel:{{ $official->phones[0] }}" class="group relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-red-500 focus:outline-none focus:border-red-300 focus:z-10 transition ease-in-out duration-150">
                                        <x-icon-phone class="w-5 h-5 text-gray-500 group-hover:text-red-500" />
                                        <span class="ml-2">Call</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</section>
@endsection
