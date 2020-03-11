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
            @include('partials.resource-link', [
                'title' => 'Kansas Voter Registration',
                'description' => 'Check your status and get registered',
                'url' => 'https://www.ksvotes.org',
                'color' => 'blue',
            ])
            @include('partials.resource-link', [
                'title' => 'Sedgwick County Election Page',
                'description' => 'Information provided by the Sedgwick County Election Office.',
                'url' => 'https://www.sedgwickcounty.org/elections/how-do-i-vote',
                'color' => 'red',
            ])
        </div>
        <div class="sm:w-1/2 sm:mx-6">
            @include('partials.resource-link', [
                'title' => 'Kansas Voter ID Information',
                'description' => 'List of valid photo IDs, requirements, exemptions, and how to get a free ID.',
                'url' => 'http://www.gotvoterid.com',
                'color' => 'red',
            ])
            @include('partials.resource-link', [
                'title' => 'League of Women Voters in Kansas',
                'description' => 'An organization (not just for women) that works to empower voters and encourage civic engagement.',
                'url' => 'https://lwvk.org',
                'color' => 'blue',
            ])
        </div>
    </div>
</section>

@endsection
