@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/post/{{ $post->id }}" method="post">
                            @csrf
                            <textarea class="card-text" rows="5" style="width: 100%" name="newpost">{{ $post->content }}</textarea>
                            <small>{{ $post->created_at->format("d.m.Y. H:i:s") }}</small>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                            <br>
                            <input type="submit" class="btn btn-outline-secondary btn-sm" value="Edit">
                        </form>
                        <form action="/profile/post/{{ $post->id }}/delete" method="post">
                            @csrf
                            <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
