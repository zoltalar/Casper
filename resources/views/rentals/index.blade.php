@extends('layouts.content-sidebar')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @endif
    <h3 class="mb-4">@lang('phrases.car_rentals')</h3>
    <div class="row">
        @foreach ($cars as $car)
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('rentals.rent', ['id' => encrypt($car->id)]) }}" class="text-dark">{{ $car->model->make->name }} {{ $car->model->name }}</a>
                        </h5>
                        <h6 class="card-subtitle text-muted small mb-3">
                            {{ $car->year }},
                            {{ number_format($car->mileage) }}
                            {{ strtolower(__('phrases.miles')) }}
                            <span class="badge color-box bg-{{ $car->color }} ml-1"></span>
                        </h6>
                        <a href="{{ route('rentals.rent', ['id' => encrypt($car->id)]) }}" class="btn btn-light btn-sm">@lang('phrases.rent')</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop