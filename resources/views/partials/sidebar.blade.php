@if (isset($event))
    <h3 class="mb-4">@lang('phrases.event_options')</h3>
    @if ( (int) $event->public == 1)
        <p class="mb-4">
            <a href="{{ route('events.attend', ['event' => $event]) }}" class="btn btn-info">@if ( ! $approved && ! $invited) @lang('phrases.attend') @else @lang('phrases.cancel_attendance') @endif</a>
            @if ($event->created_by == auth()->id())
                <a href="{{ route('events.destroy', ['event' => $event]) }}" class="btn btn-danger ml-1">@lang('phrases.delete')</a>
            @endif
        </p>
    @else
        {{ Form::open(['route' => 'events.invite', 'class' => 'form-inline mb-4', 'autocomplete' => 'off']) }}
            <div class="form-group">
                <autocomplete :source="'{{ route('users.load') }}'"></autocomplete>
            </div>
            <div class="form-group ml-2">
                {{ Form::submit(__('phrases.invite')) }}
            </div>
            @if ($errors->any())
                <div class="invalid-feedback d-block">
                    {{ $errors->first() }}
                </div>
            @endif
            {{ Form::hidden('event_id', $event->id) }}
        {{ Form::close() }}
    @endif
    @if ($users->count() > 0)
        <h5>@lang('phrases.attendees')</h5>
        <ul class="mb-4">
            @foreach ($users as $_user)
                <li>{{ $_user->fullName(false) }} @if ( (int) $_user->pivot->approved == 0) <small class="text-warning text-uppercase">(@lang('phrases.pending_approval')</small> @endif</li>
            @endforeach
        </ul>
    @endif
    @if ($invited && ! $approved)
        <h5>@lang('phrases.pending_invitation')</h5>
        <p class="mb-0">
            <a href="{{ route('events.approve', ['event' => $event]) }}" class="btn btn-primary mr-1">@lang('phrases.approve')</a>
            <a href="{{ route('events.reject', ['event' => $event]) }}" class="btn btn-danger">@lang('phrases.reject')</a>
        </p>
    @endif
@else
    <h3 class="mb-4">@lang('phrases.filter_events')</h3>
    @if ( ! empty($address))
        <p class="mb-4">@lang('messages.proximity_search', ['radius' => $radius, 'address' => $address, 'coordinates' => $coordinates]) <a href="{{ route('events.unfilter') }}">@lang('phrases.change')</a></p>
    @else
        <p>@lang('messages.filter_events')</p>
        {{ Form::open(['route' => 'events.filter', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('input-address', __('phrases.address')) }}
                {{ Form::text('address', null, ['required' => 'required']) }}
                @if ($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-city', __('phrases.city')) }}
                {{ Form::text('city', null, ['required' => 'required']) }}
                @if ($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-state-id', __('phrases.state')) }}
                {{ Form::select('state_id', ['' => ''] + \App\Models\State::states(), null, ['required' => 'required']) }}
                @if ($errors->has('state_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-postal-code', __('phrases.postal_code')) }}
                {{ Form::text('postal_code', null, ['required' => 'required']) }}
                @if ($errors->has('postal_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postal_code') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('input-radius', __('phrases.radius')) }}
                {{ Form::select('radius', ['' => ''] + $radii, null, ['required' => 'required']) }}
                @if ($errors->has('radius'))
                    <div class="invalid-feedback">
                        {{ $errors->first('radius') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::submit(__('phrases.filter')) }}
            </div>
        {{ Form::close() }}
    @endif
@endif