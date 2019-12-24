@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h3>{{ $event->name }}</h3></div>
                    <div class="card-body text-center">
                        <h5>Location: {{ $event->location }}</h5>
                        <h5>Date: {{ $event->date }}</h5>
                        <h5>Host: {{ $event->user->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
