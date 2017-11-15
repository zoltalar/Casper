@extends('layouts.content-sidebar')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @elseif ( ! empty($address) && $coordinates->empty())
        <alert class="alert-danger">We were unable to determine latitude and longitude of the {{ $address }} address.</alert>
    @endif
    <h3 class="mb-4">Upcoming Events</h3>
    <p class="mb-4">
        <a href="{{ route('event.create') }}" class="btn btn-info">Create Event</a>
    </p>
    @if ( ! empty($address) && ! $coordinates->empty())
        <p class="mb-4">Searching within 20 mile radius of <mark>{{ $address }}</mark>. <a href="{{ route('home') }}">Change</a></p>
    @endif
    @if ($events->count() > 0)
        @foreach ($events as $event)
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <a href="{{ route('event.show', ['name' => str_slug($event->name), 'id' => $event->id]) }}">{{ $event->name }}</a>
                    </h5>
                    <p class="text-muted mb-1">
                        {{ $event->meta() }}
                    </p>
                    <p class="text-muted mb-3">
                        {{ $event->address(',') }}
                    </p>
                    <p class="mb-0">{{ \App\Extensions\Str::words($event->description, 30) }}</p>
                </div>
            </div>
        @endforeach
        {{ $events->links() }}
    @else
        <p>No Events Found</p>
    @endif
@endsection