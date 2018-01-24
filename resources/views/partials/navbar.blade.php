<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Casper') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-primary">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item"><span class="navbar-text">Hello {{ auth()->user()->first_name }}</span></li>
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link" v-on:click="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            @else
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link"><i class="fa fa-user-o" aria-hidden="true"></i> Register</a></li>
            @endauth
        </ul>
        {{ Form::open(['route' => 'logout', 'class' => 'd-none', 'ref' => 'formLogout']) }}{{ Form::close() }}
    </div>
</nav>