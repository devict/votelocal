@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscribers</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Subscriber Number</th>
                        <th>Subscribed?</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($subscribers as $subscriber)
                        <tr>
                          <td>{{ $subscriber->number }}</td>
                          <td>{{ $subscriber->subscribed ? 'X' : '' }}</td>
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
