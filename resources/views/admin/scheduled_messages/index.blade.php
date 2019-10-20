@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="/admin/scheduled_messages/new" class="btn btn-success btn-sm float-right">New Message</a>
                    Scheduled Messages
                </div>

                <div class="card-body">
                    @include('partials.errors')

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sent</th>
                                <th>Target</th>
                                <th>Send At</th>
                                <th>Body (en)</th>
                                <th>Body (es)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduled_messages as $scheduled_message)
                                <tr>
                                    <td>{{ $scheduled_message->sent ? 'X' : '' }}</td>
                                    <td>
                                        @if( $scheduled_message->target_sms ) SMS @endif 
                                        @if( $scheduled_message->target_sms and $scheduled_message->target_twitter ) / @endif 
                                        @if( $scheduled_message->target_twitter ) Twitter @endif
                                    </td>
                                    <td>{{ $scheduled_message->send_at->format('m/d/Y g:i A') }}</td>
                                    <td>{{ $scheduled_message->body_en }}</td>
                                    <td>{{ $scheduled_message->body_es }}</td>
                                    <td>
                                    @if ($scheduled_message->sent)
                                        <!-- TODO: create a send report view -->
                                        <a href="/admin/scheduled_messages/{{ $scheduled_message->id }}/messages" class="btn btn-primary btn-sm">
                                            View Messages
                                        </a>
                                    @else
                                        <a href="/admin/scheduled_messages/{{ $scheduled_message->id }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <a href="/admin/scheduled_messages/{{ $scheduled_message->id }}/delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
                                            Delete
                                        </a>
                                    @endif
                                    </td>
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
