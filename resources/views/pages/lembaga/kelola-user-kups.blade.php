@extends('layouts.dashboard')

@section('title', 'Kelola User KUPS')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola User KUPS</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('lembaga-kups/user') }}">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Dipilih</span>

                    <div class="col-lg-8">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('lembaga_kups') is-invalid @enderror"
                                name="lembaga_kups" id="user-kups" aria-label="Lembaga KUPS" autofocus>
                                <option value="" hidden>-</option>
                                @foreach ($kups as $kups)
                                    <option value="{{ $kups['id'] }}">
                                        {{ $kups['kups_name'] }} - {{ $kups['ps_name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user-kups">Lembaga KUPS <span class="text-danger fw-bold">*</span></label>

                            @error('lembaga_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('user') is-invalid @enderror" name="user"
                                id="user" aria-label="Daftar User" autofocus>
                                <option value="" hidden>-</option>
                                @foreach ($user as $user)
                                    <option value="{{ $user['id'] }}">
                                        {{ $user['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="user">Daftar User <span class="text-danger fw-bold">*</span></label>

                            @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('lembaga-kups') }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <!-- Table with stripped rows -->
                <table class="table kups-extra-datatable">
                    <thead>
                        <tr>
                            <th scope="col no">#</th>
                            <th scope="col name">Nama User</th>
                            <th scope="col other">KUPS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($list as $list)
                            <tr>
                                <td scope="row">
                                    {{ ++$i }}
                                </td>
                                <td>{{ $list['name'] }}</td>
                                <td>
                                    @foreach ($list['kups'] as $kups)
                                        {{ $kups['kups_name'] }} - {{ $kups['ps_name'] }}
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </main>
@endsection
