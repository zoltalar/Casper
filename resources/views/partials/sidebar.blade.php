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