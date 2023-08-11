<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="{{ url('/') }}"><span>SOBAT-</span>PS</a></h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ url('/') }}">Home</a></li>
                @auth
                    <li><a class="getstarted scrollto" href="{{ route('dashboard') }}">Dashboard</a></li>
                @else
                    <li><a class="getstarted scrollto" href="{{ route('register') }}">Daftar</a></li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
