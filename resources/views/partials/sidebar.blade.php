@if (isset($event))
    <h3 class="mb-4">Event Options</h3>
    @if ( (int) $event->public == 1)
        <p class="mb-4">
            <a href="{{ route('event.attend', ['id' => $event->id]) }}" class="btn btn-info">@if ( ! $approved && ! $invited) Attend @else Cancel Attendance @endif</a>
        </p>
    @else
        {{ Form::open(['route' => 'event.invite', 'class' => 'form-inline mb-4', 'autocomplete' => 'off']) }}
            <div class="form-group">
                <autocomplete :source="'/users/load'"></autocomplete>
            </div>
            <div class="form-group ml-2">
                {{ Form::submit('Invite') }}
            </div>
            {{ Form::hidden('event_id', $event->id) }}
        {{ Form::close() }}
    @endif
    @if ($users->count() > 0)
        <h5>Attendees</h5>
        <ul class="mb-4">
            @foreach ($users as $_user)
                <li>{{ $_user->fullName() }} @if ( (int) $_user->pivot->approved == 0) <small class="text-warning text-uppercase">(Pending Approval)</small> @endif</li>
            @endforeach
        </ul>
    @endif
    @if ($invited && ! $approved)
        <h5>Pending Invitation</h5>
        <p class="mb-0">
            <a href="{{ route('event.approve', ['id' => $event->id]) }}" class="btn btn-primary mr-1">Approve</a>
            <a href="{{ route('event.reject', ['id' => $event->id]) }}" class="btn btn-danger">Reject</a>
        </p>
    @endif
@else
    <h3 class="mb-4">Filter Events</h3>
    @if ( ! empty($address) && ! $coordinates->empty())
        <p class="mb-4">Searching within {{ $radius }} mile radius of <mark>{{ $address }}</mark>. <a href="{{ route('home') }}">Change</a></p>
    @else
        {{ Form::open(['route' => 'home', 'method' => 'get']) }}
            <div class="form-group">
                {{ Form::label('input-address', 'Address') }}
                {{ Form::text('address', null, ['required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('input-city', 'City') }}
                {{ Form::text('city', null, ['required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('input-state-id', 'State') }}
                {{ Form::select('state_id', \App\Models\State::states(), null, ['required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('input-postal-code', 'Postal Code') }}
                {{ Form::text('postal_code', null, ['required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('input-radius', 'Radius') }}
                {{ Form::select('radius', $radii, null, ['required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Filter') }}
            </div>
        {{ Form::close() }}
    @endif
@endif