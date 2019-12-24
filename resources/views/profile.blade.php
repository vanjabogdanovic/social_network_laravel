@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <img class="rounded-circle" src="../img/{{ $user->id }}.png" width=7% onerror="this.onerror=null;this.src='../img/default.png';">
                    <h5 class="card-title text-secondary d-inline pl-3">{{ $user->name . trans('profile.posts')}}</h5>
                </div>
                <div class="card-body">
                    @foreach($posts as $post)
                        <form action="/post/{{ $post->id }}" method="get">
                            @csrf
                            <p class="card-text d-inline">{{ $post->content }}</p>
                            <input type="submit" class="btn btn-outline-secondary border-bottom border-top border-left-0 border-right-0 btn-sm" value="Edit">
                            <br>
                            <small>{{ $post->created_at->format("d.m.Y. H:i:s") }}</small>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                        </form>
                        <form action="/profile/post/{{ $post->id }}/delete" method="post">
                            @csrf
                            <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                        </form>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('partials.errors')
            @if(session()->has('success'))
                <div class="card-body">
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            @endif
            <div id="accordion">
                <div class="card">
                    <div class="card-header text-center">
                        <a class="card-link" data-toggle="collapse" href="#collapseSocial">
                            Social Networks
                        </a>
                    </div>
                    <div id="collapseSocial" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            @foreach($user->socialNetworks as $socialNetwork)
                                @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                    <form action="/social-media/{{ $socialNetwork->id }}/delete" method="post">
                                        @csrf
                                        <div class="container">
                                            <div class="row p-1">
                                                <div class="col">
                                                <a href="{{ $socialNetwork->url }}">{{ $socialNetwork->type }}</a>
                                                </div>
                                                <div class="col">
                                                <input type="submit" class="btn btn-outline-danger btn-sm float-right" value="Delete">
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="pb-2">
                                    <a href="{{ $socialNetwork->url }}">{{ $socialNetwork->type }}</a>
                                    </div>
                                @endif
                            @endforeach
                            <div class="mt-4">
                                @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                    <form action="/social-media" method="post">
                                        @csrf
                                        <label for="type">Social network:</label>
                                        <input type="text" name="type" class="form-control">
                                        <br>
                                        <label for="url">Url:</label>
                                        <input type="text" name="url" class="form-control">
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-block" value="Add">
                                        <br><br>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->profile != null && $user->id != \Illuminate\Support\Facades\Auth::user()->id)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header text-center">
                            <a class="card-link" data-toggle="collapse" href="#collapseInfo">
                                Informations
                            </a>
                        </div>
                        <div id="collapseInfo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <h5 class="card-title">Name:</h5>
                                <p class="card-text">{{ $user->profile->name }}</p>
                                <h5 class="card-title">Last Name:</h5>
                                <p class="card-text">{{ $user->profile->lastname }}</p>
                                <h5 class="card-title">Bio:</h5>
                                <p class="card-text">{{ $user->profile->bio }}</p>
                                <h5 class="card-title">Gender:</h5>
                                <p class="card-text">{{ $user->profile->gender }}</p>
                                <h5 class="card-title">Date of Birth:</h5>
                                <p class="card-text">{{ $user->profile->dob }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header text-center">
                            <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                                Update Info
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <form action="/user/{{ $user->id }}" method="post">
                                    @csrf
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->profile ? $user->profile->name : "" }}">
                                    <br>
                                    <label for="last">Last Name:</label>
                                    <input type="text" name="lastname" class="form-control" value="{{ $user->profile ? $user->profile->lastname : "" }}">
                                    <br>
                                    <label for="bio">Bio:</label>
                                    <textarea name="bio" class="form-control" cols="30" rows="3">{{ $user->profile ? $user->profile->bio : "" }}</textarea>
                                    <br>
                                    <label for="gender">Gender:</label> <br>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary {{ $user->profile && $user->profile->gender == "female" ? "active" : "" }}">
                                            <input type="radio" name="gender" id="option1" autocomplete="off" value="female" {{ $user->profile && $user->profile->gender == "female" ? "checked" : "" }}> Female
                                        </label>
                                        <label class="btn btn-primary {{ $user->profile && $user->profile->gender == "male" ? "active" : "" }}">
                                            <input type="radio" name="gender" id="option2" autocomplete="off" value="male" {{ $user->profile && $user->profile->gender == "male" ? "checked" : "" }}> Male
                                        </label>
                                        <label class="btn btn-primary {{ $user->profile && $user->profile->gender == "other" ? "active" : "" }}">
                                            <input type="radio" name="gender" id="option3" autocomplete="off" value="other" {{ $user->profile && $user->profile->gender == "other" ? "checked" : "" }}> Other
                                        </label>
                                    </div>
                                    <br><br>
                                    <label for="dob">Date of birth:</label>
                                    <input type="date" name="dob" class="form-control" value="{{ $user->profile ? $user->profile->dob : "" }}">
                                    <br>
                                    @if($user->profile == null)
                                       <input type="submit" class="btn btn-primary btn-block" value="Add">
                                    @else
                                        <input type="submit" class="btn btn-primary btn-block" value="Update">
                                    @endif
                                    <br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header text-center">
                            <a class="card-link" data-toggle="collapse" href="#collapseThree">
                                Events
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                    @foreach($events as $event)
                                        <div class="pb-1">
                                            <form action="/event/{{ $event->id }}/delete" method="post">
                                                @csrf
                                                <a href="/event/{{ $event->id }}">{{ $event->name }}</a>
                                                <button type="submit" class="btn btn-danger btn-sm p-0">
                                                    <span class="badge badge-danger">&#9932;</span>
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                    @endforeach
                                @else
                                    @foreach($events as $event)
                                        <a href="/event/{{ $event->id }}">{{ $event->name }}</a>
                                        <br>
                                    @endforeach
                                @endif
                                <form action="/event" method="post">
                                    @csrf
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control">
                                    <br>
                                    <label for="dob">Date:</label>
                                    <input type="date" name="date" class="form-control">
                                    <br>
                                    <label for="last">Location:</label>
                                    <input type="text" name="location" class="form-control">
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-block" value="Create">
                                    <br><br>
                                </form>
                            </div>
                        </div>
                    @endif
                    @if($user->id != \Illuminate\Support\Facades\Auth::user()->id)
                        <div class="card">
                            <div class="card-header text-center">
                                <a class="card-link" data-toggle="collapse" href="#collapseFour">
                                    {{ $user->name }}'s Events
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach($events as $event)
                                        <div class="pb-2">
                                            <a href="/event/{{ $event->id }}">{{ $event->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
