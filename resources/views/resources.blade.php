@extends('layouts.app')

@section('content')

<header>
    <div class="max-w-5xl mx-auto px-4 flex justify-between sm:px-8 sm:items-center pt-8 md:pt-16">
        <div class="mr-auto sm:w-1/2">
            <h1 class="text-2xl font-medium leading-tight font-display sm:text-4xl">@lang('Voting Resources')</h1>
            <p class="text-lg leading-normal">@lang('Find useful information about voting and elections in Kansas at the links below.')</p>
        </div>
        <div class="flex-none mr-4 w-16 sm:w-32 md:w-64 sm:mr-0">
            @include('partials.resources')
        </div>
    </div>
</header>

<section class="max-w-5xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
    <div class="sm:flex sm:-mx-8">
        <div class="w-full sm:w-1/2 sm:mx-6">
            @include('partials.resource-link', [
                'title' => __('Kansas Voter Registration'),
                'description' => __('Check your status and get registered'),
                'url' => 'https://ksvotes.org/',
                'color' => 'blue',
                'target' => '_blank',
            ])
            @include('partials.resource-link', [
                'title' => __('Sedgwick County Election Page'),
                'description' => __('Information provided by the Sedgwick County Election Office.'),
                'url' => 'https://www.sedgwickcounty.org/elections/how-do-i-vote',
                'color' => 'red',
                'target' => '_blank',
            ])
            @include('partials.resource-link', [
                'title' => __('KMUW’s 2020 Election Blueprint'),
                'description' => __('Wichita’s NPR station provides election news, information and resources.'),
                'url' => 'https://www.kmuw.org/topic/election-2020',
                'color' => 'blue',
                'target' => '_blank',
            ])
        </div>
        <div class="sm:w-1/2 sm:mx-6">
            @include('partials.resource-link', [
                'title' => __('Kansas Voter ID Information'),
                'description' => __('List of valid photo IDs, requirements, exemptions, and how to get a free ID.'),
                'url' => 'http://www.gotvoterid.com',
                'color' => 'red',
                'target' => '_blank',
            ])
            @include('partials.resource-link', [
                'title' => __('League of Women Voters in Kansas'),
                'description' => __('An organization (not just for women) that works to empower voters and encourage civic engagement.'),
                'url' => 'http://lwvk.org/elections-and-voting/voting',
                'color' => 'blue',
                'target' => '_blank',
            ])
        </div>
    </div>
</section>

<section class="bg-white">
  <div class="max-w-screen-xl mx-auto px-4 pb-12 sm:px-6 lg:pb-16 lg:px-8">
    <div class="px-6 py-6 bg-blue-200 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
      <div class="xl:w-0 xl:flex-1">
        <h2 class="text-2xl leading-8 font-extrabold tracking-tight text-blue-800 sm:text-3xl sm:leading-9">
          @lang('Find Your Elected Officials')
        </h2>
        <p class="mt-3 max-w-3xl text-lg leading-6 text-blue-700" id="newsletter-headline">
          @lang('Discover who represents you at each level of government.')
        </p>
      </div>
      <div class="mt-8 flex lg:flex-shrink-0 lg:mt-0">
        <div class="inline-flex rounded-md shadow">
        <a href="{{ route('elected-officials.index') }}" class="btn bg-red-500 font-medium px-6 py-4">
          @lang('Get Started')
          <x-icon-arrow-forward width="20" class="inline-block ml-2 -mr-1" />
        </a>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection
