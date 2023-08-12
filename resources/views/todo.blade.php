@extends('layouts.dashboard')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <main id="main" class="main">

        <div class="container">
            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>404</h1>
                <h2>The page you are looking for doesn't exist.</h2>
                <a class="btn" href="{{ url('dashboard') }}">Kembali ke Dashboard</a>
            </section>
        </div>

    </main>
@endsection
