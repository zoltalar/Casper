@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">@lang('phrases.create_event')</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'event.store', 'table' => 'events']) }}
                        <div class="form-group">
                            {{ Form::label('input-name', __('phrases.event_name')) }}
                            {{ Form::text('name', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-description', __('phrases.description')) }}
                            {{ Form::textarea('description') }}
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-date', __('phrases.date')) }}
                            {{ Form::date('date') }}
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-time', __('phrases.time')) }}
                            {{ Form::time('time', null, [':disabled' => 'event.allDay']) }}
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('all_day', 1, null, ['v-model' => 'event.allDay']) }}
                                    @lang('phrases.all_day_event')
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-address', __('phrases.address')) }}
                            {{ Form::text('address') }}
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-address-2', __('phrases.address_2')) }}
                            {{ Form::text('address_2') }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-city', __('phrases.city')) }}
                            {{ Form::text('city') }}
                            @if ($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-state-id', __('phrases.state')) }}
                            {{ Form::select('state_id', $states) }}
                            @if ($errors->has('state_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-postal-code', __('phrases.postal_code')) }}
                            {{ Form::text('postal_code') }}
                            @if ($errors->has('postal_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('postal_code') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-max-attendees', __('phrases.max_attendees')) }}
                            {{ Form::text('max_attendees') }}
                            @if ($errors->has('max_attendees'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_attendees') }}
                                </div>
                            @else
                                <small class="form-text text-muted">
                                    @lang('messages.max_attendees_help')
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('public') }}
                                    @lang('phrases.public')
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('phrases.create')) }}
                            <a href="{{ route('home') }}" class="btn btn-link">@lang('phrases.cancel')</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop