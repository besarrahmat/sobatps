@extends('layouts.dashboard')

@section('title', 'Edit Program ' . $program['program_num'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Program {{ $program['program_num'] }}</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('program/' . $program['id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nama_program') is-invalid @enderror"
                                name="nama_program" id="nama-program" placeholder="Nama Kegiatan Bantuan"
                                value="{{ old('nama_program', $program['program']) }}" autofocus>
                            <label for="nama-program">Nama Kegiatan Bantuan <span
                                    class="text-danger fw-bold">*</span></label>

                            @error('nama_program')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3 mb-4">
                        <label for="tanggal-daftar" class="col-form-label">Rentang Waktu Pendaftaran <span
                                class="text-danger fw-bold">*</span></label>
                        <div class="input-group" id="tanggal-daftar">
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                name="tanggal_mulai" id="tanggal-mulai"
                                value="{{ old('tanggal_mulai', $program['start_date']) }}">
                            <span class="input-group-text">hingga</span>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                name="tanggal_selesai" id="tanggal-selesai"
                                value="{{ old('tanggal_selesai', $program['end_date']) }}">
                        </div>

                        @error('tanggal_mulai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('tanggal_selesai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="no_program" id="nomor-program"
                                placeholder="Nomor" value="{{ old('no_program', $program['program_num']) }}" disabled>
                            <label for="nomor-program">Nomor</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tanggal_kak') is-invalid @enderror"
                                name="tanggal_kak" id="tanggal-kak" placeholder="Tanggal KAK"
                                value="{{ old('tanggal_kak', $program['kak_date']) }}">
                            <label for="tanggal-kak">Tanggal KAK <span class="text-danger fw-bold">*</span></label>

                            @error('tanggal_kak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" step="100" min="0"
                                class="form-control @error('alokasi_dana') is-invalid @enderror" name="alokasi_dana"
                                id="alokasi-dana" placeholder="Alokasi Anggaran"
                                value="{{ old('alokasi_dana', $program['budget_allocation']) }}"
                                onblur="if(this.value < 0) this.value = 1"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="alokasi-dana">Alokasi Anggaran <span class="text-danger fw-bold">*</span></label>

                            @error('alokasi_dana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="file-kak" class="col-form-label">File KAK</label>
                        <a class="link-file" href="{{ asset('storage/' . $program['kak_file']) }}" target="_new"
                            @if ($program['kak_file'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control @error('file_kak') is-invalid @enderror" type="file" id="file-kak"
                            name="file_kak">

                        @error('file_kak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('program/' . $program['id']) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
