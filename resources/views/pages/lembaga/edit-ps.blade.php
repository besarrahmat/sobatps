@extends('layouts.dashboard')

@section('title', 'Edit ' . $ps['ps_name'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit {{ $ps['ps_name'] }}</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('lembaga-ps/' . $ps['id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nama_ps') is-invalid @enderror" name="nama_ps"
                                id="nama-ps" placeholder="Nama Lembaga PS" value="{{ old('nama_ps', $ps['ps_name']) }}"
                                autofocus>
                            <label for="nama-ps">Nama Lembaga PS <span class="text-danger fw-bold">*</span></label>

                            @error('nama_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('jenis_ps') is-invalid @enderror" name="jenis_ps"
                                id="tipe-ps" aria-label="Jenis PS">
                                @foreach ($tipe as $jenis)
                                    <option value="{{ $jenis['id'] }}"
                                        @if (old('kab_kota_ps', $ps['kab_kota']) == $jenis['id']) {{ 'selected' }} @endif>
                                        {{ $jenis['type'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="tipe-ps">Jenis PS <span class="text-danger fw-bold">*</span></label>

                            @error('jenis_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('kab_kota_ps') is-invalid @enderror"
                                name="kab_kota_ps" id="kab-kota-ps" aria-label="Kab/Kota PS">
                                @foreach ($kab_kota_list as $kab_kota)
                                    <option value="{{ $kab_kota['kode'] }}"
                                        @if (old('kab_kota_ps', $ps['kab_kota']) == $kab_kota['kode']) {{ 'selected' }} @endif>
                                        {{ $kab_kota['daerah'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="kab-kota-ps">Kab/Kota PS <span class="text-danger fw-bold">*</span></label>

                            @error('kab_kota_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('kecamatan_ps') is-invalid @enderror"
                                name="kecamatan_ps" id="kec-ps" aria-label="Kecamatan PS" disabled>
                                @foreach ($kecamatan_list as $kecamatan)
                                    <option value="{{ $kecamatan['kode'] }}"
                                        @if (old('kecamatan_ps', $ps['kecamatan']) == $kecamatan['kode']) {{ 'selected' }} @endif>
                                        {{ $kecamatan['daerah'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="kec-ps">Kecamatan PS <span class="text-danger fw-bold">*</span></label>

                            @error('kecamatan_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('desa_ps') is-invalid @enderror" name="desa_ps"
                                id="desa-ps" aria-label="Desa PS" disabled>
                                @foreach ($desa_list as $desa)
                                    <option value="{{ $desa['kode'] }}"
                                        @if (old('desa_ps', $ps['region_code']) == $desa['kode']) {{ 'selected' }} @endif>
                                        {{ $desa['daerah'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="desa-ps">Desa PS <span class="text-danger fw-bold">*</span></label>

                            @error('desa_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('no_sk_ps') is-invalid @enderror"
                                name="no_sk_ps" id="nomor-sk" placeholder="Nomor SK"
                                value="{{ old('no_sk_ps', $ps['ps_sk_num']) }}">
                            <label for="nomor-sk">Nomor SK <span class="text-danger fw-bold">*</span></label>

                            @error('no_sk_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tgl_sk_ps') is-invalid @enderror"
                                name="tgl_sk_ps" id="tanggal-sk" placeholder="Tanggal SK"
                                value="{{ old('tgl_sk_ps', $ps['ps_date']) }}">
                            <label for="tanggal-sk">Tanggal SK <span class="text-danger fw-bold">*</span></label>

                            @error('tgl_sk_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('luas_sk_ps') is-invalid @enderror" name="luas_sk_ps"
                                id="luas-sk" placeholder="Luas SK" value="{{ old('luas_sk_ps', $ps['area']) }}"
                                onblur="if(this.value < 0) this.value = 1; this.value = parseFloat(this.value).toFixed(2);"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46))">
                            <label for="luas-sk">Luas SK <span class="text-danger fw-bold">*</span></label>

                            @error('luas_sk_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('ketua_ps') is-invalid @enderror"
                                name="ketua_ps" id="ketua-ps" placeholder="Nama Ketua"
                                value="{{ old('ketua_ps', $ps['ps_chief']) == 'xxx' ? '' : old('ketua_ps', $ps['ps_chief']) }}">
                            <label for="ketua-ps">Nama Ketua</label>

                            @error('ketua_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="number" step="1" min="0"
                                class="form-control @error('total_kk') is-invalid @enderror" name="total_kk"
                                id="total-kk" placeholder="Jumlah KK" value="{{ old('total_kk', $ps['kk_total']) }}"
                                onblur="if(this.value < 0) this.value = 1;"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="total-kk">Jumlah KK <span class="text-danger fw-bold">*</span></label>

                            @error('total_kk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="tel" class="form-control @error('kontak_ps') is-invalid @enderror"
                                name="kontak_ps" id="kontak-ps" placeholder="Nomor Kontak" maxlength="13"
                                value="{{ old('kontak_ps', $ps['ps_contact']) == 'xxx' ? '' : old('kontak_ps', $ps['ps_contact']) }}"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="kontak-ps">Nomor Kontak</label>

                            @error('kontak_ps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('fungsi_kawasan') is-invalid @enderror"
                                name="fungsi_kawasan" id="fungsi-kawasan" aria-label="Fungsi Kawasan">
                                <option value="xxx" @if (old('fungsi_kawasan', $ps['area_function']) == 'xxx') {{ 'selected' }} @endif>
                                    -
                                </option>
                                <option value="HL" @if (old('fungsi_kawasan', $ps['area_function']) == 'HL') {{ 'selected' }} @endif>
                                    HL
                                </option>
                                <option value="HL,HPT" @if (old('fungsi_kawasan', $ps['area_function']) == 'HL,HPT') {{ 'selected' }} @endif>
                                    HL,HPT
                                </option>
                                <option value="HP" @if (old('fungsi_kawasan', $ps['area_function']) == 'HP') {{ 'selected' }} @endif>
                                    HP
                                </option>
                                <option value="HP,HPT" @if (old('fungsi_kawasan', $ps['area_function']) == 'HP,HPT') {{ 'selected' }} @endif>
                                    HP,HPT
                                </option>
                                <option value="HPK" @if (old('fungsi_kawasan', $ps['area_function']) == 'HPK') {{ 'selected' }} @endif>
                                    HPK
                                </option>
                                <option value="HPT" @if (old('fungsi_kawasan', $ps['area_function']) == 'HPT') {{ 'selected' }} @endif>
                                    HPT
                                </option>
                            </select>
                            <label for="fungsi_kawasan">Fungsi Kawasan <span class="text-danger fw-bold">*</span></label>

                            @error('fungsi-kawasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="file-sk" class="col-form-label">File SK</label>
                        <a class="link-file" href="{{ asset('berkas/' . $ps['sk_file']) }}" target="_new"
                            @if ($ps['sk_file'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control form-PS @error('file_sk_ps') is-invalid @enderror" type="file"
                            id="file-sk" name="file_sk_ps">

                        @error('file_sk_ps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="file-rku" class="col-form-label">File RKU</label>
                        <a class="link-file" href="{{ asset('berkas/' . $ps['rku_file']) }}" target="_new"
                            @if ($ps['rku_file'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control form-PS @error('file_rku_ps') is-invalid @enderror" type="file"
                            id="file-rku" name="file_rku_ps">

                        @error('file_rku_ps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="file-rkt" class="col-form-label">File RKT</label>
                        <a class="link-file" href="{{ asset('berkas/' . $ps['rkt_file']) }}" target="_new"
                            @if ($ps['rkt_file'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control form-PS @error('file_rkt_ps') is-invalid @enderror" type="file"
                            id="file-rkt" name="file_rkt_ps">

                        @error('file_rkt_ps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="file-shp" class="col-form-label">File SHP</label>
                        <a class="link-file" href="{{ asset('berkas/' . $ps['shp_file']) }}" target="_new"
                            @if ($ps['shp_file'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control form-PS @error('file_shp_ps') is-invalid @enderror" type="file"
                            id="file-shp" name="file_shp_ps">

                        @error('file_shp_ps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('lembaga-ps/' . $ps['id']) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection

@section('page-js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kab-kota-ps').on('change', function() {
                var kab_kota = $(this).val();
                if (kab_kota) {
                    $.ajax({
                        url: 'kode/' + kab_kota,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kec-ps').attr('disabled', false).empty();
                                $('#kec-ps').append(
                                    '<option value="" hidden>-</option>');
                                $.each(data, function(key, query) {
                                    $('select[id="kec-ps"]').append(
                                        '<option value="' + query.kode + '" >' +
                                        query.daerah + '</option>');
                                });
                            } else {
                                $('#kec-ps').empty();
                            }
                        }
                    });
                } else {
                    $('#kec-ps').empty();
                }
            });
            $('#kec-ps').on('change', function() {
                var kecamatan = $(this).val();
                if (kecamatan) {
                    $.ajax({
                        url: 'kode/' + kecamatan,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#desa-ps').attr('disabled', false).empty();
                                $('#desa-ps').append(
                                    '<option value="" hidden>-</option>');
                                $.each(data, function(key, query) {
                                    $('select[id="desa-ps"]').append(
                                        '<option value="' + query.kode + '">' +
                                        query.daerah + '</option>');
                                });
                            } else {
                                $('#desa-ps').empty();
                            }
                        }
                    });
                } else {
                    $('#desa-ps').empty();
                }
            });
        });
    </script>
@stop
