@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">News feed</div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @elseif(session()->has('alert'))
                        <div class="alert alert-danger">
                            {{ session()->get('alert') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    @include('partials.errors')
                    <form action="/home" method="post">
                        @csrf
                        <textarea name="content" cols="30" rows="5" class="form-control" placeholder="What's on your mind..."></textarea>
                        <br>
                        <input type="submit" class="btn btn-primary float-right pl-5 pr-5" value="Post">
                    </form>
                </div>
            </div>
            <hr>
            @foreach($posts as $post)
                @if($post->user->id == Auth::user()->id)
                    <div class="card mb-1">
                        <form action="/post/{{ $post->id }}" method="get">
                            @csrf
                            <div class="card-header">
                                <img class="rounded-circle d-inline" src="../img/{{ $post->user_id }}.png" width=7% onerror="this.onerror=null;this.src='../img/default.png';">
                                <a href="user/{{ $post->user_id }}" class="card-title text-secondary d-inline pl-3">
                                    <h5 class="card-title d-inline">{{ $post->user->name . trans('profile.posts')}}</h5>
                                </a>
                            </div>
                            <div class="card-body pb-0">
                                <p class="d-inline">{{ $post->content }}</p>
                                <input type="submit" class="btn btn-outline-secondary border-bottom border-top border-left-0 border-right-0 btn-sm" value="Edit">
                                <br>
                                <small>{{ $post->created_at->format("d.m.Y. H:i:s") }}</small>
                                <small>{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </form>
                        <div class="card-body pt-0">
                            <form action="/post/{{ $post->id }}/delete" method="post">
                                @csrf
                                <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card mb-1">
                        <div class="card-header">
                            <img class="rounded-circle d-inline" src="../img/{{ $post->user_id }}.png" width=7% onerror="this.onerror=null;this.src='../img/default.png';">
                            <a href="user/{{ $post->user_id }}" class="card-title text-secondary d-inline pl-3">
                                <h5 class="card-title d-inline">{{ $post->user->name . trans('profile.posts')}}</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="d-inline">{{ $post->content }}</p>
                            <input type="submit" class="btn btn-outline-secondary border-bottom border-top border-left-0 border-right-0 btn-sm" value="Edit">
                            <br>
                            <small>{{ $post->created_at->format("d.m.Y. H:i:s") }}</small>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header">
                    Events
                </div>
                <div class="card-body">
                    @foreach($events as $event)
                        <h5><a href="event/{{ $event->id }}">{{ $event->name }}</a></h5>
                    @endforeach
                </div>
            </div>

            @if(count($mutuals))
                <div class="card mb-2">
                    <div class="card-header">
                        Mutual friends
                    </div>
                    <div class="card-body">
                        @foreach($mutuals as $follow)
                            <form action="/unfollow/{{ $follow->id }}" method="post">
                                @csrf
                                <div class="container">
                                    <div class="row p-1">
                                        <div class="col">
                                            <h5 class="d-inline"><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                                        </div>
                                        <div class="col">
                                            <input type="submit" class="btn btn-danger btn-sm float-right" name="mutuals" value="Unfollow">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($following))
                <div class="card mb-2">
                    <div class="card-header">
                        Users I'm following
                    </div>
                    <div class="card-body">
                        @foreach($following as $follow)
                            <form action="/unfollow/{{ $follow->id }}" method="post">
                                @csrf
                                <div class="container">
                                    <div class="row p-1">
                                        <div class="col">
                                            <h5 class="d-inline"><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                                        </div>
                                        <div class="col">
                                            <input type="submit" class="btn btn-danger btn-sm float-right" name="following" value="Unfollow">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($followers))
                <div class="card mb-2">
                    <div class="card-header">
                        My followers
                    </div>
                    <div class="card-body">
                        @foreach($followers as $follow)
                            <form action="/follow/{{ $follow->id }}" method="post">
                                @csrf
                                <div class="container">
                                    <div class="row p-1">
                                        <div class="col">
                                            <h5 class="d-inline"><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                                        </div>
                                        <div class="col">
                                            <input type="submit" class="btn btn-primary btn-sm float-right" name="followers" value="Follow back">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($others))
                <div class="card mb-2">
                    <div class="card-header">
                        Suggestions
                    </div>
                    <div class="card-body">
                        @foreach($others as $follow)
                            <form action="/follow/{{ $follow->id }}" method="post">
                                @csrf
                                <div class="container">
                                    <div class="row p-1">
                                        <div class="col">
                                            <h5 class="d-inline"><a href="user/{{ $follow->id }}">{{ $follow->name }}</a></h5>
                                        </div>
                                        <div class="col">
                                            <input type="submit" class="btn btn-primary btn-sm float-right" name="followers" value="Follow">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
