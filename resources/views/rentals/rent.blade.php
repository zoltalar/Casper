@extends('layouts.content-sidebar')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <a href="{{ route('rentals.index') }}" class="btn btn-light btn-sm pull-right">@lang('phrases.change')</a>
            <h5 class="card-title">{{ $car->model->make->name }} {{ $car->model->name }}</h5>
            <h6 class="card-subtitle text-muted small mb-0">
                {{ $car->year }},
                {{ number_format($car->mileage) }}
                {{ strtolower(__('phrases.miles')) }}
                <span class="badge color-box bg-{{ $car->color }} ml-1"></span>
            </h6>
        </div>
    </div>
    {{ Form::open(['route' => 'rentals.store']) }}
        {{ Form::hidden('user_id', encrypt(auth()->id())) }}
        {{ Form::hidden('car_id', encrypt($car->id)) }}
        <div class="form-group">
            {{ Form::label('input-date-range', __('phrases.date_range')) }}
            <date-range :start-target="'#input-from'" :end-target="'#input-to'" :invalid-dates-source="'{{ route('rentals.rental-dates', ['car' => $car ]) }}'"></date-range>
            {{ Form::hidden('from', old('from', $rental->from), ['id' => 'input-from']) }}
            {{ Form::hidden('to', old('to', $rental->to), ['id' => 'input-to']) }}
            @if ($errors->any())
                <div class="invalid-feedback d-block">
                    {{ $errors->first() }}
                </div>
            @else
                <small class="form-text text-muted">
                    @lang('messages.date_range_help')
                </small>
            @endif
        </div>
        <div class="form-group">
            {{ Form::submit(__('phrases.rent')) }}
            <a href="{{ route('rentals.index') }}" class="btn btn-link">@lang('phrases.cancel')</a>
        </div>
    {{ Form::close() }}
@stop