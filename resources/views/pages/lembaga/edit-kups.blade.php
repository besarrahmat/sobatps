@extends('layouts.dashboard')

@section('title', 'Edit ' . $kups['kups_name'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit {{ $kups['kups_name'] }}</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('lembaga-kups/' . $kups['id']) }}">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('lembaga_ps') is-invalid @enderror"
                                name="lembaga_ps" id="lembaga-ps" aria-label="Lembaga PS">
                                @foreach ($ps as $ps)
                                    <option value="{{ $ps['id'] }}"
                                        @if (old('lembaga_ps', $kups['ps_id']) == $ps['id']) {{ 'selected' }} @endif>
                                        {{ $ps['ps_name'] }} ({{ $ps['address'] }})
                                    </option>
                                @endforeach
                            </select>
                            <label for="lembaga-ps">Lembaga PS <span class="text-danger fw-bold">*</span></label>

                            @error('lembaga_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nama_kups') is-invalid @enderror"
                                name="nama_kups" id="nama-kups" placeholder="Nama Lembaga KUPS"
                                value="{{ old('nama_kups', $kups['kups_name']) }}" autofocus>
                            <label for="nama-kups">Nama Lembaga KUPS <span class="text-danger fw-bold">*</span></label>

                            @error('nama_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('no_sk_kups') is-invalid @enderror"
                                name="no_sk_kups" id="nomor-sk" placeholder="Nomor SK"
                                value="{{ old('no_sk_kups', $kups['kups_sk_num']) == 'xxx' ? '' : old('no_sk_kups', $kups['kups_sk_num']) }}">
                            <label for="nomor-sk">Nomor SK</label>

                            @error('no_sk_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('jenis_usaha') is-invalid @enderror"
                                name="jenis_usaha" id="jenis-usaha" placeholder="Jenis Usaha"
                                value="{{ old('jenis_usaha', $kups['business_type']) == 'xxx' ? '' : old('jenis_usaha', $kups['business_type']) }}">
                            <label for="jenis-usaha">Jenis Usaha</label>

                            @error('jenis_usaha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('komoditas') is-invalid @enderror"
                                name="komoditas" id="komoditas" placeholder="Komoditas"
                                value="{{ old('komoditas', $kups['comodity']) == 'xxx' ? '' : old('komoditas', $kups['comodity']) }}">
                            <label for="komoditas">Komoditas</label>

                            @error('komoditas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('kelas') is-invalid @enderror" name="kelas"
                                id="class" aria-label="Kategori Kelas">
                                <option value="" hidden>-</option>
                                <option value="1" @if (old('kelas', $kups['class']) == '1') {{ 'selected' }} @endif>
                                    PLATINUM
                                </option>
                                <option value="2" @if (old('kelas', $kups['class']) == '2') {{ 'selected' }} @endif>
                                    GOLD
                                </option>
                                <option value="3" @if (old('kelas', $kups['class']) == '3') {{ 'selected' }} @endif>
                                    SILVER
                                </option>
                                <option value="4" @if (old('kelas', $kups['class']) == '4') {{ 'selected' }} @endif>
                                    BLUE
                                </option>
                            </select>
                            <label for="class">Kategori Kelas <span class="text-danger fw-bold">*</span></label>

                            @error('kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('ketua_kups') is-invalid @enderror"
                                name="ketua_kups" id="ketua-kups" placeholder="Nama Ketua"
                                value="{{ old('ketua_kups', $kups['kups_chief']) == 'xxx' ? '' : old('ketua_kups', $kups['kups_chief']) }}">
                            <label for="ketua-kups">Nama Ketua</label>

                            @error('ketua_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('kontak_kups') is-invalid @enderror"
                                name="kontak_kups" id="kontak-kups" placeholder="Nomor Kontak" maxlength="13"
                                value="{{ old('kontak_kups', $kups['kups_contact']) == 'xxx' ? '' : old('kontak_kups', $kups['kups_contact']) }}"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="kontak-kups">Nomor Kontak</label>

                            @error('kontak_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('lembaga-kups/' . $kups['id']) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
