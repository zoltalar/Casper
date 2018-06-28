<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\State;
use Validator;

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

    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->fill($request->only($event->getUnguarded()));
        $event->save();

        session()->flash('message', 'Event has been created successfully.');

        return redirect()->route('home');
    }

    public function show($name, Event $event = null)
    {
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

    public function attend(Event $event = null)
    {
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
            'event' => $event
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

    public function approve(Event $event = null)
    {
        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();
        $event->users()->updateExistingPivot($id, ['approved' => 1]);

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'event' => $event
        ]);
    }

    public function reject(Event $event = null)
    {
        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();
        $event->users()->detach($id);

        return redirect()->route('event.show', [
            'name' => str_slug($event->name),
            'event' => $event
        ]);
    }

    public function destroy(Event $event = null)
    {
        if ($event !== null && $event->created_by == auth()->id()) {
            try {
                $event->delete();
            } catch (\Exception $e) {}
        }

        return redirect()->route('home');
    }
}