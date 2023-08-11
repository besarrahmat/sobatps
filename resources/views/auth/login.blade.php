@extends('layouts.default')

@section('content')
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="{{ url('/') }}"><span>Sobat-</span>PS</a></h1>

            <a class="getstarted" href="{{ route('register') }}">Daftar</a>
        </div>
    </header>

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Login Akun</h5>
                            </div>

                            <form class="row g-3" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">&nbsp; Ingat saya</span>
                                    </label>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary btn-auth w-100" type="submit">Login</button>
                                </div>

                                {{-- @if (Route::has('password.request'))
                                    <a class="text-center" href="{{ route('password.request') }}">
                                        Lupa password?
                                    </a>
                                @endif --}}
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
