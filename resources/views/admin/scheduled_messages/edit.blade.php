@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Scheduled Message</div>

                <div class="card-body">
                    @include('admin.scheduled_messages.form', [
                        'scheduled_message' => $scheduled_message,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
