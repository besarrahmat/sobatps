@extends('layouts.dashboard')

@section('title', 'Tambah Progress')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Progress</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('progress') }}" enctype="multipart/form-data">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <input type="hidden" id="usulan_id" name="usulan_id" value="{{ $usulan_id }}">

                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('aktivitas') is-invalid @enderror"
                                name="aktivitas" id="aktivitas" placeholder="Aktivitas" value="{{ old('aktivitas') }}"
                                autofocus>
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
                                id="tanggal-aktivitas" placeholder="Tanggal Aktivitas" value="{{ old('tanggal') }}">
                            <label for="tanggal-aktivitas">Tanggal Aktivitas <span
                                    class="text-danger fw-bold">*</span></label>

                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="dokumentasi" class="col-form-label">Dokumentasi <span
                                class="text-danger fw-bold">*</span></label>
                        <input class="form-control form-PS @error('dokumentasi') is-invalid @enderror" type="file"
                            id="dokumentasi" name="dokumentasi">

                        @error('dokumentasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('usulan/' . $usulan_id) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
