@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">@lang('phrases.reset_password')</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['route' => 'password.email']) }}
                        <div class="form-group">
                            {{ Form::label('input-email', __('phrases.email_address')) }}
                            {{ Form::text('email', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('phrases.send_password_reset_link')) }}
                            <a class="btn btn-link" href="{{ route('login') }}">@lang('phrases.cancel')</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop