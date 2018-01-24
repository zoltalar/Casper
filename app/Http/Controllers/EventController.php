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

        $users = $event->users()->get();
        $user = $event->user();

        $invited = $approved = false;

        if ($user !== null) {
            $invited = (bool) $user->pivot->invited;
            $approved = (bool) $user->pivot->approved;
        }

        return view('events/show', compact('event', 'invited', 'approved', 'users'));
    }

    public function attend($id)
    {
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();

        if ($event->user() === null) {
            $event->users()->attach($id, ['approved' => 1]);
        } else {
            $event->users()->detach($id);
        }

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'id' => $event->id
        ]);
    }

    public function invite()
    {
        $data = request()->only(['id', 'event_id']);
        $data['user_id'] = null;

        if ( ! empty($data['id'])) {
            $data['user_id'] = decrypt($data['id']);
        }

        unset($data['id']);
        $id = $data['event_id'];
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        $rules = [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $id = $data['user_id'];
            $user = $event->user($id);

            if ($user === null) {
                $event->users()->attach($id, ['invited' => 1]);
            }
        }

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'id' => $event->id
        ]);
    }

    public function approve($id)
    {
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();
        $event->users()->updateExistingPivot($id, ['approved' => 1]);

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'id' => $event->id
        ]);
    }

    public function reject($id)
    {
        $event = Event::find($id);

        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();
        $event->users()->detach($id);

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'id' => $event->id
        ]);
    }
}