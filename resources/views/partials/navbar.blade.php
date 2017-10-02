<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Casper') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-primary">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            @guest
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            @endguest
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>