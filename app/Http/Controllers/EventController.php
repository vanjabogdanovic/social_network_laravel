<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index($id)
    {
        $event = Event::findOrFail($id);
        return view("event", ['event' => $event]);
    }

    public function createEvent(CreateEventRequest $request)
    {
        $id = Auth::user()->id;
        $info = new Event();
        $info->user_id = $id;
        $info->name = $request->name;
        $info->date = $request->date;
        $info->location = $request->location;
        $info->save();
        return redirect("\user\\" . $id)->with('success', 'Informations updated!');
    }
}
