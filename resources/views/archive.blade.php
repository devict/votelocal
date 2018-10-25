@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 36rem">
    <h1 class="page-title">Message Archive</h1>
    @foreach($messages as $message)
        <div class="card mb-5">
            <div class="card-body">
                <p class="lead">{{ $message->body }}</p>

                <small class="mt-3 d-block text-muted text-monospace">
                    {{ $message->send_at->toDayDateTimeString() }}
                </small>
            </div>
        </div>
    @endforeach

    {{ $messages->links() }}
</div>

@endsection
