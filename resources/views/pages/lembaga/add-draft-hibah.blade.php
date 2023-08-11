@extends('layouts.dashboard')

@section('title', 'Tambah Usulan Calon Penerima Hibah')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Calon Penerima Hibah</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('draft-hibah') }}" enctype="multipart/form-data">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <div class="col-sm-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                id="tanggal" placeholder="Tanggal" value="{{ old('tanggal') }}" autofocus>
                            <label for="tanggal">Tanggal <span class="text-danger fw-bold">*</span></label>

                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('kups_pendamping') is-invalid @enderror"
                                name="kups_pendamping" id="pendamping-kups" aria-label="Lembaga KUPS">
                                <option value="" hidden>-</option>
                                @foreach ($kups as $kups)
                                    <option value="{{ $kups['id'] }}">
                                        {{ $kups['kups_name'] }} - {{ $kups['ps_name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="pendamping-kups">Lembaga KUPS <span class="text-danger fw-bold">*</span></label>

                            @error('kups_pendamping')
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
