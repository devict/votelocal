@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/admin/scheduled_messages" class="btn btn-success btn-sm float-right">Back</a>
                    Messages for Scheduled Message #{{ $scheduled_message->id }}
                </div>

                <div class="card-body">
                    @include('partials.errors')

                    <table class="table">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Body</th>
                                <th>Sent At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduled_message->messages as $message)
                                <tr>
                                    <td>
                                        @if ($message->subscriber)
                                            <a href="/admin/subscribers/{{ $message->subscriber->id }}/messages">
                                                {{ $message->to }}
                                            </a>
                                        @else
                                            {{ $message->to }}
                                        @endif
                                    </td>
                                    <td>{{ $message->from }}</td>
                                    <td>{{ $message->body }}</td>
                                    <td>{{ $message->created_at->format('m/d/Y g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
