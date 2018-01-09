<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Event;
use App\Models\State;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');

        parent::__construct();
    }

    public function create()
    {
        $states = State::states();

        return view('events/create', compact('states'));
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

        $id = auth()->id();
        $users = $event->users()->get();
        $attend = true;

        if ($users->contains($id)) {
            $attend = false;
        }

        return view('events/show', compact('event', 'attend', 'users'));
    }

    public function attend($id)
    {
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();

        if ($event->users()->get()->contains($id)) {
            $event->users()->detach($id);
        } else {
            $event->users()->attach($id);
        }

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'id' => $event->id
        ]);
    }
}