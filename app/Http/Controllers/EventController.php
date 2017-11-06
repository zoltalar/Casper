<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('events/create');
    }

    public function store()
    {
        $rules = Event::rules();
        $data = request()->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()
                ->route('event.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $event = new Event();
            $event->fill($data);

            if ($event->save()) {
                session()->flash('message', 'Event has been created successfully.');
            }

            return redirect()->route('home');
        }
    }

    public function show($name, $id)
    {
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        return view('events/show', compact('event'));
    }
}