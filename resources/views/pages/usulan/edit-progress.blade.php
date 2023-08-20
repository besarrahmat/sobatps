@extends('layouts.dashboard')

@section('title', 'Edit Progress')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Progress</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('progress/' . $progress['id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('aktivitas') is-invalid @enderror"
                                name="aktivitas" id="aktivitas" placeholder="Aktivitas"
                                value="{{ old('aktivitas', $progress['activity']) }}" autofocus>
                            <label for="aktivitas">Aktivitas <span class="text-danger fw-bold">*</span></label>

                            @error('aktivitas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                id="tanggal-aktivitas" placeholder="Tanggal Aktivitas"
                                value="{{ old('tanggal', $progress['date']) }}">
                            <label for="tanggal-aktivitas">Tanggal Aktivitas <span
                                    class="text-danger fw-bold">*</span></label>

                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="dokumentasi" class="col-form-label">Dokumentasi</label>
                        <a class="link-file" href="{{ asset('berkas/' . $progress['documentation']) }}" target="_new">
                            <i class="bx bx-link-alt"></i>
                            Lihat File Awal
                        </a>
                        <input class="form-control @error('dokumentasi') is-invalid @enderror" type="file"
                            id="dokumentasi" name="dokumentasi">

                        @error('dokumentasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('usulan/' . $progress['usulan_id']) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
