@extends('layouts.content-sidebar')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @elseif ( ! empty($address) && $coordinates->empty())
        <alert class="alert-danger">@lang('messages.address_coordinates_error', ['address' => $address])</alert>
    @endif
    <h3 class="mb-4">@lang('phrases.upcoming_events')</h3>
    <p class="mb-4">
        <a href="{{ route('events.create') }}" class="btn btn-info">@lang('phrases.create_event')</a>
    </p>
    @if ($events->count() > 0)
        @foreach ($events as $_event)
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">
                        <a href="{{ route('events.show', ['name' => str_slug($_event->name), 'event' => $_event]) }}">{{ $_event->name }}</a>
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
                            <span class="badge badge-info">@lang('phrases.public_event')</span>
                        @else
                            <span class="badge badge-secondary">@lang('phrases.private_event')</span>
                        @endif
                        @if ($_event->user() !== null)
                            @if ( (int) $_event->user()->pivot->approved == 1)
                                <span class="badge badge-success">@lang('phrases.attending')</span>
                            @elseif ( (int) $_event->user()->pivot->invited == 1)
                                <span class="badge badge-warning">@lang('phrases.pending_invitation')</span>
                            @endif
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
        {{ $events->links() }}
    @else
        <p>@lang('messages.no_events')</p>
    @endif
@stop