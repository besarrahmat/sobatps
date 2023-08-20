@extends('layouts.dashboard')

@section('title', 'Edit Kelengkapan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Kelengkapan</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('kelengkapan/' . $kelengkapan['id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <input type="hidden" id="tipe-file" name="jenis_file" value="{{ $tipe }}">

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('jenis_file') is-invalid @enderror"
                                name="jenis_file" id="tipe-file" aria-label="Jenis Kelengkapan" disabled>
                                @foreach ($extra_list as $extra)
                                    <option value="{{ $extra->id }}"
                                        @if (old('jenis_file', $tipe) == $extra->id) {{ 'selected' }} @endif>
                                        {{ $extra->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="tipe-file">Jenis Kelengkapan <span class="text-danger fw-bold">*</span></label>

                            @error('jenis_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tgl_laporan') is-invalid @enderror"
                                name="tgl_laporan" id="tanggal-laporan" placeholder="Tanggal Pelaporan"
                                value="{{ old('tgl_laporan', $kelengkapan['tanggal']) }}" autofocus>
                            <label for="tanggal-laporan">Tanggal Pelaporan <span
                                    class="text-danger fw-bold">*</span></label>

                            @error('tgl_laporan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="file-laporan" class="col-form-label">File Kelengkapan</label>
                        <a class="link-file" href="{{ asset('berkas/' . $kelengkapan['file']) }}" target="_new">
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control @error('file_laporan') is-invalid @enderror" type="file"
                            id="file-laporan" name="file_laporan">

                        @error('file_laporan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mt-3">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <div>
                            <textarea class="form-control form-new-proposal @error('deskripsi') is-invalid @enderror" style="height: 100px"
                                id="deskripsi" name="deskripsi">{{ old('deskripsi', $kelengkapan['deskripsi']) == '-' ? '' : old('deskripsi', $kelengkapan['deskripsi']) }}</textarea>

                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('usulan/' . $kelengkapan['usulan_id']) }}"
                            class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
