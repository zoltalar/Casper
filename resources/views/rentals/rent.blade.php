@extends('layouts.content-sidebar')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $car->model->make->name }} {{ $car->model->name }}</h5>
            <h6 class="card-subtitle text-muted small mb-0">
                {{ $car->year }},
                {{ number_format($car->mileage) }}
                {{ strtolower(__('phrases.miles')) }}
                <span class="badge color-box bg-{{ $car->color }} ml-1"></span>
            </h6>
        </div>
    </div>
    {{ Form::open([]) }}
        {{ Form::hidden('user_id', encrypt(auth()->id())) }}
        {{ Form::hidden('car_id', encrypt($car->id)) }}
        <div class="form-group">
            {{ Form::label('input-date-range', __('phrases.date_range')) }}
            <date-range :start-target="'#input-from'" :end-target="'#input-to'"></date-range>
            {{ Form::hidden('from', null, ['id' => 'input-from']) }}
            {{ Form::hidden('to', null, ['id' => 'input-to']) }}
        </div>
    {{ Form::close() }}
@stop