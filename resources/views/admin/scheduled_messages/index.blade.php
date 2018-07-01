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
                    @if ($errors->any())
                        <div class="alert alert-success" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sent</th>
                                <th>Send At</th>
                                <th>Body</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduled_messages as $scheduled_message)
                                <tr>
                                    <td>{{ $scheduled_message->sent ? 'X' : '' }}</td>
                                    <td>{{ date('m/d/Y @ g:i A', strtotime($scheduled_message->send_at)) }}</td>
                                    <td>{{ $scheduled_message->body }}</td>
                                    <td>
                                    @if ($scheduled_message->sent)
                                        <!-- TODO: create a send report view -->
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
