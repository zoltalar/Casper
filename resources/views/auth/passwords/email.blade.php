@extends('layouts.full-width')
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-0">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['route' => 'password.email']) }}
                        <div class="form-group">
                            {{ Form::label('input-email', 'Email Address') }}
                            {{ Form::text('email', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Send Password Reset Link') }}
                            <a class="btn btn-link" href="{{ route('login') }}">Cancel</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection