@extends('layouts.content-sidebar')
@section('content')
    <div class="row">
        @foreach ($cars as $car)
            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->model->make->name }} {{ $car->model->name }}</h5>
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