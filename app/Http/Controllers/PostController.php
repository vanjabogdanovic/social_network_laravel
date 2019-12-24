<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostProfileRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function viewPost($id) {
        $post = Post::findOrFail($id);
        return view('edit_post', ['post' => $post]);
    }

    public function updatePost(UpdatePostProfileRequest $request)
    {
        $post = Post::find($request->id);
        $id = $post->id;
        $post->content = $request->newpost;
        $post->save();
        return redirect("\post\\" . $id)->with('success', 'Informations updated!');
    }
}

