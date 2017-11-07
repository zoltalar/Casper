@extends('layouts.app')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @endif
    <a href="{{ route('event.create') }}" class="btn btn-info pull-right">Create Event</a>
    <h3 class="mb-4">Upcoming Events</h3>
    @if ($events->count() > 0)
        @foreach ($events as $event)
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-2">
                        <a href="{{ route('event.show', ['name' => str_slug($event->name), 'id' => $event->id]) }}">{{ $event->name }}</a>
                    </h5>
                    <p class="text-muted mb-2">
                        {{ $event->meta() }}
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