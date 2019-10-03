@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p><strong>Total subscribers</strong>: {{ $subscriberCount }}</p>
                    <p><strong>Subscribes in the last week</strong>: {{ $subscribersThisWeek }}</p>
                    <p><strong>English Subscribers</strong>: {{ $subscribersEN }}</p>
                    <p><strong>Spanish Subscribers</strong>: {{ $subscribersES }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
