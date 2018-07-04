@extends('layouts.full-width')
@section('content')
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card border-0">
				<div class="card-header">@lang('phrases.register')</div>
				<div class="card-body">
					{{ Form::open(['route' => 'register', 'table' => 'users']) }}
						<div class="form-group">
							{{ Form::label('input-first-name', __('phrases.first_name')) }}
							{{ Form::text('first_name', null, ['required' => 'required', 'autofocus' => 'autofocus']) }}
							@if ($errors->has('first_name'))
								<div class="invalid-feedback">
									{{ $errors->first('first_name') }}
								</div>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('input-last-name', __('phrases.last_name')) }}
							{{ Form::text('last_name', null, ['required' => 'required']) }}
							@if ($errors->has('last_name'))
								<div class="invalid-feedback">
									{{ $errors->first('last_name') }}
								</div>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('input-email', __('phrases.email_address')) }}
							{{ Form::email('email', null, ['required' => 'required']) }}
							@if ($errors->has('email'))
								<div class="invalid-feedback">
									{{ $errors->first('email') }}
								</div>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('input-nick', __('phrases.nick')) }}
							{{ Form::text('nick', null, ['required' => 'required']) }}
							@if ($errors->has('nick'))
								<div class="invalid-feedback">
									{{ $errors->first('nick') }}
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
						</div>
						<div class="form-group">
							{{ Form::label('input-dob', __('phrases.date_of_birth')) }}
							{{ Form::date('dob', null, ['required' => 'required']) }}
							@if ($errors->has('dob'))
								<div class="invalid-feedback">
									{{ $errors->first('dob') }}
								</div>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('input-gender', __('phrases.gender')) }}
							{{ Form::select('gender', ['' => ''] + $genders, null, ['required' => 'required']) }}
							@if ($errors->has('gender'))
								<div class="invalid-feedback">
									{{ $errors->first('gender') }}
								</div>
							@endif
						</div>
						<div class="form-group">
							{{ Form::submit(__('phrases.register')) }}
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop