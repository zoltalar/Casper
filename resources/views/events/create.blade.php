@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Create Event</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'event.store']) }}
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