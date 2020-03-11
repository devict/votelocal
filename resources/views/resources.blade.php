@extends('layouts.app')

@section('content')

<header>
    <div class="max-w-5xl mx-auto px-4 flex justify-between sm:px-8 sm:items-center pt-8 md:pt-16">
        <div class="mr-auto sm:w-1/2">
            <h1 class="text-2xl font-medium leading-tight font-display sm:text-4xl">@lang('resources.intro')</h1>
            <p class="text-lg leading-normal">@lang('resources.tagline')</p>
        </div>
        <div class="flex-none mr-4 w-16 sm:w-32 md:w-64 sm:mr-0">
            @include('partials.resources')
        </div>
    </div>
</header>

<section class="max-w-5xl mx-auto py-10 sm:py-20 sm:px-8 ">
    <div class="sm:flex sm:-mx-8">
        <div class="w-full sm:w-1/2 sm:mx-6">
            <a
                href="https://www.ksvotes.org/"
                class="block p-4 rounded-lg flex items-start mb-6 hover:bg-gray-100"
            >
                <div class="p-2 rounded-full shadow-lg mr-6 bg-blue-100">
                    @include('partials.icon', [
                        'name' => 'arrow-up-right',
                        'width' => '40',
                        'height' => '40',
                        'class' => 'block text-blue-500'
                    ])
                </div>
                <div>
                    <h2 class="text-2xl font-display font-medium text-blue-500">Kansas Voter Registration</h2>
                    <p>Check your status and get registered</p>
                </div>
            </a>
            <a
                href="https://www.sedgwickcounty.org/elections/how-do-i-vote/"
                class="block p-4 rounded-lg flex items-start mb-6 hover:bg-gray-100"
            >
                <div class="p-2 rounded-full shadow-lg mr-6 bg-red-100">
                    @include('partials.icon', [
                        'name' => 'arrow-up-right',
                        'width' => '40',
                        'height' => '40',
                        'class' => 'block text-red-500'
                    ])
                </div>
                <div>
                    <h2 class="text-2xl font-display font-medium text-red-500">Sedgwick County Election Page</h2>
                    <p>Information provided by the Sedgwick County Election Office.</p>
                </div>
            </a>
        </div>
        <div class="sm:w-1/2 sm:mx-6">
            <a
                href="http://www.gotvoterid.com/"
                class="block p-4 rounded-lg flex items-start mb-6 hover:bg-gray-100"
            >
                <div class="p-2 rounded-full shadow-lg mr-6 bg-red-100">
                    @include('partials.icon', [
                        'name' => 'arrow-up-right',
                        'width' => '40',
                        'height' => '40',
                        'class' => 'block  text-red-500'
                    ])
                </div>
                <div>
                    <h2 class="text-2xl font-display font-medium text-red-500">Kansas Voter ID Information</h2>
                    <p>List of valid photo IDs, requirements, exemptions, and how to get a free ID.</p>
                </div>
            </a>
            <a
                href="https://lwvk.org/"
                class="block p-4 rounded-lg flex items-start mb-6 hover:bg-gray-100"
            >
                <div class="p-2 rounded-full shadow-lg mr-6 bg-blue-100">
                    @include('partials.icon', [
                        'name' => 'arrow-up-right',
                        'width' => '40',
                        'height' => '40',
                        'class' => 'block text-blue-500'
                    ])
                </div>
                <div>
                    <h2 class="text-2xl font-display font-medium text-blue-500">League of Women Voters in Kansas</h2>
                    <p>An organization (not just for women) that works to empower voters and encourage civic engagement.</p>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection
