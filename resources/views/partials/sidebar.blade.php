@if (isset($event))
    <h3 class="mb-4">Event Options</h3>
    @if ( (int) $event->public == 1)
        <p class="mb-4">
            <a href="{{ route('event.attend', ['event' => $event]) }}" class="btn btn-info">@if ( ! $approved && ! $invited) Attend @else Cancel Attendance @endif</a>
            @if ($event->created_by == auth()->id())
                <a href="{{ route('event.destroy', ['event' => $event]) }}" class="btn btn-danger ml-1">Delete</a>
            @endif
        </p>
    @else
        {{ Form::open(['route' => 'event.invite', 'class' => 'form-inline mb-4', 'autocomplete' => 'off']) }}
            <div class="form-group">
                <autocomplete :source="'/users/load'"></autocomplete>
            </div>
            <div class="form-group ml-2">
                {{ Form::submit('Invite') }}
            </div>
            @if ($errors->any())
                <div class="invalid-feedback d-block">
                    {{ $errors->first() }}
                </div>
            @endif
            {{ Form::hidden('event_id', $event->id) }}
        {{ Form::close() }}
    @endif
    @if ($users->count() > 0)
        <h5>Attendees</h5>
        <ul class="mb-4">
            @foreach ($users as $_user)
                <li>{{ $_user->fullName(false) }} @if ( (int) $_user->pivot->approved == 0) <small class="text-warning text-uppercase">(Pending Approval)</small> @endif</li>
            @endforeach
        </ul>
    @endif
    @if ($invited && ! $approved)
        <h5>Pending Invitation</h5>
        <p class="mb-0">
            <a href="{{ route('event.approve', ['event' => $event]) }}" class="btn btn-primary mr-1">Approve</a>
            <a href="{{ route('event.reject', ['event' => $event]) }}" class="btn btn-danger">Reject</a>
        </p>
    @endif
@else
    <h3 class="mb-4">Filter Events</h3>
    @if ( ! empty($address))
        <p class="mb-4">Searching within {{ $radius }} mile radius of <mark>{{ $address }} <code>[{{ $coordinates }}]</code></mark>. <a href="{{ route('event.unfilter') }}">Change</a></p>
    @else
        {{ Form::open(['route' => 'event.filter', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('input-address', 'Address') }}
                {{ Form::text('address', null, ['required' => 'required']) }}
                @if ($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-city', 'City') }}
                {{ Form::text('city', null, ['required' => 'required']) }}
                @if ($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-state-id', 'State') }}
                {{ Form::select('state_id', ['' => ''] + \App\Models\State::states(), null, ['required' => 'required']) }}
                @if ($errors->has('state_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-postal-code', 'Postal Code') }}
                {{ Form::text('postal_code', null, ['required' => 'required']) }}
                @if ($errors->has('postal_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postal_code') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-radius', 'Radius') }}
                {{ Form::select('radius', ['' => ''] + $radii, null, ['required' => 'required']) }}
                @if ($errors->has('radius'))
                    <div class="invalid-feedback">
                        {{ $errors->first('radius') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::submit('Filter') }}
            </div>
        {{ Form::close() }}
    @endif
@endif