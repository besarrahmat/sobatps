@extends('layouts.dashboard')

@section('title', 'Penyetujuan Kelengkapan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Penyetujuan Kelengkapan</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table -->
                            <table class="table table-detail table-striped table-bordered detail-view">
                                <tbody>
                                    <tr>
                                        <th>Jenis Asistensi</th>
                                        <td>{{ $jenis['tipe'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $kelengkapan['deskripsi'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $kelengkapan['tanggal'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen</th>
                                        <td>
                                            <a class="berkas" href="{{ asset('storage/' . $kelengkapan['file']) }}"
                                                target="_new">
                                                <i class="bx bx-link-alt"></i>
                                                Lihat File Kelengkapan
                                            </a>
                                        </td>
                                    </tr>
                            </table>
                            <!-- End Table -->

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="card-map mt-4">
                                <div class="card-header-map">
                                    <h3 class="card-title-map">Berikan Catatan Asistensi</h3>
                                </div>

                                <div class="card-body-map">
                                    <form class="row g-3 approve" method="POST"
                                        action="{{ url('kelengkapan/' . $kelengkapan['id'] . '/approve') }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" id="tipe-file" name="jenis_file" value="{{ $jenis['id'] }}">

                                        <div>
                                            <div class="form-check">
                                                <input type="hidden" name="approval" value="0">
                                                <input class="form-check-input @error('approval') is-invalid @enderror"
                                                    type="checkbox" id="approval" name="approval" value="1"
                                                    @if (old('approval') == 1) {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="approval">
                                                    Disetujui?
                                                </label>

                                                @error('approval')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="catatan" class="col-form-label">Catatan Approval</label>
                                            <div>
                                                <textarea class="form-control form-new-proposal @error('catatan') is-invalid @enderror" style="height: 75px"
                                                    name="catatan" id="catatan">{{ old('catatan') }}</textarea>

                                                @error('catatan')
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
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
