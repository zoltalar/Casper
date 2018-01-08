@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Create Event</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'event.store', 'table' => 'events']) }}
                        <div class="form-group">
                            {{ Form::label('input-name', 'Event Name') }}
                            {{ Form::text('name', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-description', 'Description') }}
                            {{ Form::textarea('description') }}
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-date', 'Date') }}
                            {{ Form::date('date') }}
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-time', 'Time') }}
                            {{ Form::time('time', null, [':disabled' => 'event.allDay']) }}
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('all_day', 1, null, ['v-model' => 'event.allDay']) }}
                                    All Day Event
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-address', 'Address') }}
                            {{ Form::text('address') }}
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-address-2', 'Address 2') }}
                            {{ Form::text('address_2') }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-city', 'City') }}
                            {{ Form::text('city') }}
                            @if ($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-state-id', 'State') }}
                            {{ Form::select('state_id', $states) }}
                            @if ($errors->has('state_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-postal-code', 'Postal Code') }}
                            {{ Form::text('postal_code') }}
                            @if ($errors->has('postal_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('postal_code') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-max-attendees', 'Max Attendees') }}
                            {{ Form::text('max_attendees') }}
                            @if ($errors->has('max_attendees'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_attendees') }}
                                </div>
                            @else
                                <small class="form-text text-muted">
                                    Leave field empty for unlimited attendees.
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('public') }}
                                    Public
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Create') }}
                            <a href="{{ route('home') }}" class="btn btn-link">Cancel</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection