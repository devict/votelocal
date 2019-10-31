@extends('layouts.app')

@section('content')

<div class="container">
    <div class="">
        <h1 class="page-title">@lang('resources.page_title')</h1>
        @lang('resources.tranlations_in_progress')        
    </div>        
</div>

<div class="container bg-white">
    <div class="resource-section">
        <h2 class="section-title">@lang('resources.general_section_title')</h2>
        <ul class="resource-list">
            <li>
                <h3 class="resource-title"><a href="@lang('resources.vote411.link')">@lang('resources.vote411.name')</a></h3>
                @lang('resources.vote411.description')
            </li>
            <li>
                <h3 class="resource-title"><a href="@lang('resources.voteorg.link')">@lang('resources.voteorg.name')</a></h3>
                @lang('resources.voteorg.description')
            </li>
        </ul>
    </div>

    <div class="resource-section">
        <h2 class="section-title">@lang('resources.voting_section_title')</h2>
        <ul class="resource-list">
            <li>
                <h3 class="resource-title"><a href="@lang('resources.ksgov.link')">@lang('resources.ksgov.name')</a></h3>
                <p>@lang('resources.ksgov.description')</p>
            </li>
            <li>
                <h3 class="resource-title"><a href="@lang('resources.ksvotes.link')">@lang('resources.ksvotes.name')</a></h3>
                <p>@lang('resources.ksvotes.description')</p>
            </li>
        </ul>
    </div>

    <div class="resource-section">
        <h2 class="section-title">@lang('resources.kansas_section_title')</h2>
        <ul class="resource-list">
            <li>
                <h3 class="resource-title"><a href="@lang('resources.lwvk.link')">@lang('resources.lwvk.name')</a></h3>
                <p>@lang('resources.lwvk.description')</p>
            </li>
            <li>
                <h3 class="resource-title"><a href="@lang('resources.voteks.link')">@lang('resources.voteks.name')</a></h3>
                <p>@lang('resources.voteks.description')</p>
            </li>
            <li>
                <h3 class="resource-title"><a href="@lang('resources.wichitaeagle.link')">@lang('resources.wichitaeagle.name')</a></h3>
                <p>@lang('resources.wichitaeagle.description')</p>
            </li>
        </ul>
    </div>
</div>

@endsection
