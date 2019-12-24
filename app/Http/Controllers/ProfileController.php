<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\UpdatePostProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Post;
use App\SocialNetwork;
use App\Profile;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function viewProfile($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        $events = $user->events()->orderBy('id', 'desc')->get();

        return view('profile', ['user' => $user, 'posts' => $posts, 'events' => $events]);
    }

    public function createSocialNetwork(Request $request)
    {
        $userId = Auth::user()->id;
        $socialNetwork = new SocialNetwork();
        $socialNetwork->user_id = $userId;
        $socialNetwork->type = $request->type;
        $socialNetwork->url = $request->url;
        $socialNetwork->save();

        return redirect("\user\\" . $userId)->with('success', 'Social network created!');

    }

    public function deleteSocialNetwork(Request $request)
    {
        $id = Auth::user()->id;
        $socialNetwork = SocialNetwork::find($request->id);
        $socialNetwork->delete();
        return redirect("\user\\" . $id)->with('success', 'Social network deleted!');
    }

    public function updateInfo(UpdateProfileRequest $request)
    {
        $id = Auth::user()->id;
        $info = new Profile();
        if(Auth::user()->profile)
        {
            $info = Auth::user()->profile;
        }
        $info->user_id = $id;
        $info->name = $request->name;
        $info->lastname = $request->lastname;
        $info->bio = $request->bio;
        $info->gender = $request->gender;
        $info->dob = $request->dob;
        $info->save();
        return redirect("\user\\" . $id)->with('success', 'Informations updated!');
    }

    public function deletePost(Request $request)
    {
        $id = Auth::user()->id;
        $post = Post::find($request->id);
        $post->delete();
        return redirect("\user\\" . $id)->with('success', 'Post deleted!');
    }

    public function deleteEvent(Request $request) {
        $id = Auth::user()->id;
        $event = Event::find($request->id);
        $event->delete();
        return redirect("\user\\" . $id)->with('success', 'Event deleted!');
    }

}
