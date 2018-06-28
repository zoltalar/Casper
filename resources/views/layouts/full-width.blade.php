<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('partials.head')
    <body>
        <div id="app" class="container">
            @include('partials.navbar')
            <div class="inner">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>