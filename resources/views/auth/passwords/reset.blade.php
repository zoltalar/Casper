@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">@lang('phrases.reset_password')</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'password.request']) }}
                        {{ Form::hidden('token', $token) }}
                        <div class="form-group">
                            {{ Form::label('input-email', __('phrases.email_address')) }}
                            {{ Form::email('email', ($email or old('email')), ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-password', __('phrases.password')) }}
                            {{ Form::password('password', ['required' => 'required']) }}
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-password-confirmation', __('phrases.confirm_password')) }}
                            {{ Form::password('password_confirmation', ['required' => 'required']) }}
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('phrases.reset_password')) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop