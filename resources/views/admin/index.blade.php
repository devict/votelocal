@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Dashboard</h1>
</div>
<div class="sm:flex sm:space-x-6">
    <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
        <h2 class="text-sm text-gray-600 mb-2">Schedule</h2>
        <x-calendar :events="$sendDates" />
    </div>
    <div class="flex-1 grid gap-6 grid-cols-2 sm:grid-cols-3">
        <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
            <h2 class="text-sm text-gray-600 mb-2">Total subscribers</h2>
            <div class="font-bold text-4xl">{{ $subscriberCount }}</div>
        </div>
        <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
            <h2 class="text-sm text-gray-600 mb-2">Subscribers this week</h2>
            <div class="font-bold text-4xl">{{ $subscribersThisWeek }}</div>
        </div>
        <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
            <h2 class="text-sm text-gray-600 mb-2">Pledges</h2>
            <div class="font-bold text-4xl">{{ $pledgeCount }}</div>
        </div>
        <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
            <h2 class="text-sm text-gray-600 mb-2">English Subscribers</h2>
            <div class="font-bold text-4xl">{{ $subscribersEN }}</div>
        </div>
        <div class="flex flex-col h-full bg-white rounded shadow px-4 py-5 sm:p-6">
            <h2 class="text-sm text-gray-600 mb-2">Spanish Subscribers</h2>
            <div class="font-bold text-4xl">{{ $subscribersES }}</div>
        </div>
    </div>
</div>
@endsection
