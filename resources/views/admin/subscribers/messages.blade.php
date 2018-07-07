@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Messages for {{ $subscriber->number }}
                </div>
                <div class="card-body">
                    <form class="form-inline mb-2 d-flex justify-content-end">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control mx-sm-3">
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}"{{ $value == $filters->get('type') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
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
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->to }}</td>
                                    <td>{{ $message->from }}</td>
                                    <td>{{ $message->body }}</td>
                                    <td>{{ date('m/d/Y @ g:i A', strtotime($message->created_at)) }}</td>
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
