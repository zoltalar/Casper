@extends('layouts.app')
@section('content')
    <h3 class="mb-2">{{ $event->name }}</h3>
    <p class="text-muted">
        {{ $event->meta() }}
    </p>
    {!! \App\Extensions\Str::nl2p($event->description) !!}
    <hr class="mt-4 mb-4">
    <p>
        <a href="{{ route('home') }}" class="btn btn-info">Go Back</a>
    </p>
@endsection