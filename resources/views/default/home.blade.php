@extends('layouts.content-sidebar')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @elseif (empty($address))
        <alert class="alert-danger">We were unable to determine latitude and longitude of the <strong>{{ $address }}</strong> address.</alert>
    @endif
    <h3 class="mb-4">Upcoming Events</h3>
    <p class="mb-4">
        <a href="{{ route('event.create') }}" class="btn btn-info">Create Event</a>
    </p>
    @if ($events->count() > 0)
        @foreach ($events as $_event)
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <a href="{{ route('event.show', ['name' => str_slug($_event->name), 'event' => $_event]) }}">{{ $_event->name }}</a>
                    </h5>
                    <p class="text-muted mb-1">
                        {{ $_event->meta() }}
                    </p>
                    <p class="text-muted mb-3">
                        {{ $_event->address(',') }}
                    </p>
                    <p>
                        {{ \App\Extensions\Str::words($_event->description, 30) }}
                    </p>
                    <p class="mb-0">
                        @if ( (int) $_event->public == 1)
                            <span class="badge badge-info">Public Event</span>
                        @else
                            <span class="badge badge-secondary">Private Event</span>
                        @endif
                        @if ($_event->user() !== null)
                            @if ( (int) $_event->user()->pivot->approved == 1)
                                <span class="badge badge-success">Attending</span>
                            @elseif ( (int) $_event->user()->pivot->invited == 1)
                                <span class="badge badge-warning">Pending Invitation</span>
                            @endif
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
        {{ $events->links() }}
    @else
        <p>No Events Found</p>
    @endif
@endsection