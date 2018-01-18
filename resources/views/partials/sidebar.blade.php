@if (isset($event))
    <h3 class="mb-4">Event Options</h3>
    @if ( (int) $event->public == 1)
        <p class="mb-4">
            <a href="{{ route('event.attend', ['id' => $event->id]) }}" class="btn btn-info">@if ($attend) Attend @else Unattend @endif</a>
        </p>
    @else
        {{ Form::open(['route' => 'event.invite', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
            <div class="form-group">
                <autocomplete :source="'/users/load'"></autocomplete>
            </div>
            <div class="form-group ml-2">
                {{ Form::submit('Invite') }}
            </div>
        {{ Form::close() }}
    @endif
    @if ($users->count() > 0)
        <h5>Attendees</h5>
        <ul>
            @foreach ($users as $_user)
                <li>{{ $_user->fullName() }}</li>
            @endforeach
        </ul>
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