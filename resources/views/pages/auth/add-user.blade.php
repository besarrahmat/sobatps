@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah User</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('user') }}">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama" value="{{ old('name') }}" autocomplete="name" autofocus>
                            <label for="name">Nama <span class="text-danger fw-bold">*</span></label>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email">
                            <label for="email">Email <span class="text-danger fw-bold">*</span></label>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('roles') is-invalid @enderror" name="roles"
                                id="roles" aria-label="Roles">
                                <option value="" hidden>-</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}"
                                        @if (old('roles') == $role['id']) {{ 'selected' }} @endif>
                                        {{ $role['role'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="roles">Roles <span class="text-danger fw-bold">*</span></label>

                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" autocomplete="new-password">
                            <label for="password">Password <span class="text-danger fw-bold">*</span></label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password_confirmation" id="password-confirm"
                                placeholder="Konfirmasi Password" autocomplete="new-password">
                            <label for="password-confirm">Konfirmasi Password <span
                                    class="text-danger fw-bold">*</span></label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('user') }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
