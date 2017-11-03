@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Create Event</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'event.store', 'novalidate' => 'novalidate']) }}
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