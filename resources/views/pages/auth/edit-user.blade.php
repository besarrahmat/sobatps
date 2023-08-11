@extends('layouts.dashboard')

@section('title', 'Ubah User')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ubah Identitas User</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('user/' . $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama" value="{{ old('name', $user->name) }}" autocomplete="name"
                                autofocus>
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
                                id="email" placeholder="Email" value="{{ old('email', $user->email) }}">
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
                                id="roles" aria-label="Roles" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}"
                                        @if (old('roles', $user->roles_id) == $role['id']) {{ 'selected' }} @endif>
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

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('user/' . $user->id) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

        <hr>

        <div class="pagetitle">
            <h1>Ubah Password User</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('user/' . $user->id . '/password') }}">
                    @csrf
                    @method('PATCH')

                    <div class="col-lg-4">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" id="current-password" placeholder="Password Lama"
                                autocomplete="password">
                            <label for="current-password">Password Lama</label>

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" id="new-password" placeholder="Password Baru"
                                autocomplete="new-password">
                            <label for="new-password">Password Baru</label>

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password_confirmation" id="password-confirm"
                                placeholder="Konfirmasi Password Baru" autocomplete="new-password">
                            <label for="password-confirm">Konfirmasi Password Baru</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('user/' . $user->id) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
