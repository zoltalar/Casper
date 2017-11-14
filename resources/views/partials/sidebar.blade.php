<h3 class="mb-4">Filter Events</h3>
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
        {{ Form::submit('Filter') }}
    </div>
{{ Form::close() }}