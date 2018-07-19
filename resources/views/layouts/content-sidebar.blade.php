<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('partials.head')
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
        @include('partials.footer-scripts')
    </body>
</html>