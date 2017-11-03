@extends('layouts.app')
@section('content')
    @if (session()->has('message'))
        <alert class="alert-success">{{ session()->get('message') }}</alert>
    @endif
    <a href="{{ route('event.create') }}" class="btn btn-info">Create Event</a>
@endsection