@if (isset($car))
    @if ($car->rentals->count() > 0)
        <h5 class="mb-4">@lang('messages.car_unavailability', ['make' => $car->model->make->name, 'model' => $car->model->name])</h5>
        <ul class="list-group">
            @foreach ($car->rentals as $rental)
                <li class="list-group-item @if ($rental->from->isPast() && $rental->to->isPast()) list-group-item-light @endif text-muted">
                    <i class="fa fa-clock-o mr-1"></i>
                    <small>
                        {{ $rental->from->toDateString() }}
                        {{ strtolower(__('phrases.to')) }}
                        {{ $rental->to->toDateString() }}
                    </small>
                </li>
            @endforeach
        </ul>
    @endif
@endif