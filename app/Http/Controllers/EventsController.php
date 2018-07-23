<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFilterRequest;
use App\Http\Requests\EventInviteRequest;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\State;
use App\Services\AddressGeneratorService;
use App\Services\CoordinatesResolverService;
use Validator;

class EventsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth')->except(['index', 'show', 'filter', 'unfilter']);
    }

    public function index()
    {
        $events = Event::query()
            ->where('date', '>=', date('Y-m-d'))
            ->when(!$this->coordinates->empty(), function($query) {
                $query->haversine($this->coordinates, $this->radius);
            })
            ->when(auth()->guest(), function($query) {
                $query->where('public', 1);
            })
            ->orderBy('date', 'asc')
            ->simplePaginate(4);

        $data = compact('events');

        return view('events/index', $data);
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

        return redirect()->route('events.show', [
            'name' => str_slug($event->name),
            'event' => $event
        ]);
    }

    public function invite(EventInviteRequest $request)
    {
        $eventId = $request->get('event_id');
        $userId = $request->get('id');

        if ( ! empty($userId)) {
            $userId = decrypt($userId);
        }

        $event = Event::find($eventId);

        if ($event !== null) {
            $event->users()->attach($userId, ['invited' => 1]);
        }

        return redirect()->route('events.show', [
            'name' => str_slug($event->name),
            'event' => $event
        ]);
    }

    public function approve(Event $event = null)
    {
        if ($event === null) {
            return redirect()->route('home');
        }

        $id = auth()->id();
        $event->users()->updateExistingPivot($id, ['approved' => 1]);

        return redirect()->route('events.show', [
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

        return redirect()->route('events.show', [
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

    public function filter(EventFilterRequest $request)
    {
        $address = (new AddressGeneratorService($request->all()))->get(',');
        $coordinates = (new CoordinatesResolverService($address))->resolve();
        $radius = $request->get('radius');

        if ( ! empty($address) && ! $coordinates->empty()) {
            session()->put('filter.event.address', $address);
            session()->put('filter.event.coordinates', $coordinates->toArray());

            if ( ! empty($radius)) {
                session()->put('filter.event.radius', $radius);
            }
        } else {
            session()->forget([
                'filter.event.address',
                'filter.event.coordinates',
                'filter.event.radius'
            ]);
        }

        return redirect()->route('home');
    }

    public function unfilter()
    {
        session()->forget([
            'filter.event.address',
            'filter.event.coordinates',
            'filter.event.radius'
        ]);

        return redirect()->route('home');
    }
}