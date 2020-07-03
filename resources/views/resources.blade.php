@extends('layouts.app')

@section('content')

@if($inProgress = __('resources.translations_in_progress'))
<section class="relative bg-blue-600">
  <div class="max-w-screen-xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
    <div class="pr-16 sm:text-center sm:px-16">
      <p class="font-medium text-white">
          {{ $inProgress }}
      </p>
    </div>
  </div>
</section>
@endif

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

<section class="max-w-5xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
    <div class="sm:flex sm:-mx-8">
        <div class="w-full sm:w-1/2 sm:mx-6">
            @include('partials.resource-link', [
                'title' => __('resources.ksvotes.name'),
                'description' => __('resources.ksvotes.description'),
                'url' => __('resources.ksvotes.link'),
                'color' => 'blue',
            ])
            @include('partials.resource-link', [
                'title' => __('resources.sedgwickcounty.name'),
                'description' => __('resources.sedgwickcounty.description'),
                'url' => __('resources.sedgwickcounty.link'),
                'color' => 'red',
            ])
        </div>
        <div class="sm:w-1/2 sm:mx-6">
            @include('partials.resource-link', [
                'title' => __('resources.gotvoterid.name'),
                'description' => __('resources.gotvoterid.description'),
                'url' => __('resources.gotvoterid.link'),
                'color' => 'red',
            ])
            @include('partials.resource-link', [
                'title' => __('resources.lwvk.name'),
                'description' => __('resources.lwvk.description'),
                'url' => __('resources.lwvk.link'),
                'color' => 'blue',
            ])
        </div>
    </div>
</section>

<section class="bg-white">
  <div class="max-w-screen-xl mx-auto px-4 pb-12 sm:px-6 lg:pb-16 lg:px-8">
    <div class="px-6 py-6 bg-blue-200 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
      <div class="xl:w-0 xl:flex-1">
        <h2 class="text-2xl leading-8 font-extrabold tracking-tight text-blue-800 sm:text-3xl sm:leading-9">
          @lang('resources.elected_officials.name')
        </h2>
        <p class="mt-3 max-w-3xl text-lg leading-6 text-blue-700" id="newsletter-headline">
          Discover who represents you at each level of government.
        </p>
      </div>
      <div class="mt-8 flex lg:flex-shrink-0 lg:mt-0">
        <div class="inline-flex rounded-md shadow">
        <a href="{{ route('elected-officials.index') }}" class="btn bg-red-500 font-bold px-6 py-4">
          Search now
        </a>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection
