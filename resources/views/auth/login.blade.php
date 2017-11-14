@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Login</div>
                <div class="card-body">
                    {{ Form::open(['route' => 'login']) }}
                        <div class="form-group">
                            {{ Form::label('input-email', 'Email Address or Nick') }}
                            {{ Form::text('email', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
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
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{ Form::checkbox('remember') }}
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Login') }}
                            <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection