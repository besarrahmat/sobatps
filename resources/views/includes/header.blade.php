<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="{{ url('/') }}"><span>SOBAT-</span>PS</a></h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ url('/') }}">Home</a></li>
                <li class="dropdown"><a href="{{ url('lembaga-list') }}"><span>Perizinan</span> <i
                            class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ url('lembaga-list') }}">Daftar Izin Perhutanan Sosial</a></li>
                        <li><a href="{{ url('program-list') }}">Daftar Program Perhutanan Sosial</a>
                        <li><a href="{{ url('receiver-list') }}">Daftar Penerima Bantuan Perhutanan Sosial</a>
                        <li><a href="{{ url('category-list') }}">Daftar Kategori Kelas KUPS</a>
                        </li>
                    </ul>
                </li>
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
