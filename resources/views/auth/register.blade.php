@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card border-0">
            <div class="card-header">Register</div>
            <div class="card-body">
                {{ Form::open(['route' => 'register']) }}
                    <div class="form-group">
                        {{ Form::label('input-first-name', 'First Name') }}
                        {{ Form::text('first_name', null, ['maxlength' => 100, 'required' => 'required', 'autofocus' => 'autofocus']) }}
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('input-last-name', 'Last Name') }}
                        {{ Form::text('last_name', null, ['maxlength' => 100, 'required' => 'required']) }}
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('input-email', 'E-Mail Address') }}
                        {{ Form::email('email', null, ['required' => 'required']) }}
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('input-nick', 'Nick') }}
                        {{ Form::text('nick', null, ['maxlength' => 40, 'required' => 'required']) }}
                        @if ($errors->has('nick'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nick') }}
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
                    </div>
                    <div class="form-group">
                        {{ Form::label('input-dob', 'Date of Birth') }}
                        {{ Form::date('dob', null, ['required' => 'required']) }}
                        @if ($errors->has('dob'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('input-gender', 'Gender') }}
                        {{ Form::select('gender', ['' => ''] + $genders, null, ['required' => 'required']) }}
                        @if ($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Register') }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection