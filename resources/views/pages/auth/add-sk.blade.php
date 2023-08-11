@extends('layouts.dashboard')

@section('title', 'Tambah SK')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah SK</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('list-sk') }}" enctype="multipart/form-data">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <div class="col-sm-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tanggal_sk') is-invalid @enderror"
                                name="tanggal_sk" id="tanggal-sk" placeholder="Tanggal SK" value="{{ old('tanggal_sk') }}"
                                autofocus>
                            <label for="tanggal-sk">Tanggal SK <span class="text-danger fw-bold">*</span></label>

                            @error('tanggal_sk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" id="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}">
                            <label for="keterangan">Keterangan</label>

                            @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="new-file-sk" class="col-form-label">File SK <span
                                class="text-danger fw-bold">*</span></label>
                        <input class="form-control form-PS @error('file_sk') is-invalid @enderror" type="file"
                            id="new-file-sk" name="file_sk">

                        @error('file_sk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('list-sk') }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
