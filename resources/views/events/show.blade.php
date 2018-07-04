@extends('layouts.content-sidebar')
@section('content')
    <h3 class="mb-3">{{ $event->name }}</h3>
    <p class="text-muted mb-1">
        {{ $event->meta() }}
    </p>
    <p class="text-muted">
        {{ $event->address(',') }}
    </p>
    {!! \App\Extensions\Str::nl2p($event->description) !!}
    <hr class="mt-4 mb-4">
    <p>
        <a href="{{ route('home') }}" class="btn btn-info">@lang('phrases.go_back')</a>
    </p>
@stop