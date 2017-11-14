@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'password.request']) }}
                        {{ Form::hidden('token', $token) }}
                        <div class="form-group">
                            {{ Form::label('input-email', 'Email Address') }}
                            {{ Form::email('email', ($email or old('email')), ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-password', 'Password') }}
                            {{ Form::password('password', ['required' => 'required']) }}
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('input-password-confirmation', 'Confirm Password') }}
                            {{ Form::password('password_confirmation', ['required' => 'required']) }}
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Reset Password') }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection