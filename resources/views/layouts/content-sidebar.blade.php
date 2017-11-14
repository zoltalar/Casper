<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Casper') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="container">
            @include('partials.navbar')
            <div class="inner">
                <div class="row">
                    <div class="col-md-8">
                        <div class="content">
                            @yield('content')
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sidebar">
                            @include('partials.sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>