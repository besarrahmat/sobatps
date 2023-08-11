@extends('layouts.dashboard')

@section('title', 'Tambah Usulan Bantuan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Usulan Bantuan</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('usulan') }}" enctype="multipart/form-data">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('lembaga_kups') is-invalid @enderror"
                                name="lembaga_kups" id="lembaga-kups" aria-label="Lembaga KUPS"
                                @if (Auth::user()->roles_id == 3) disabled
																@else autofocus @endif>
                                @if (Auth::user()->roles_id == 2)
                                    <option value="" hidden>-</option>
                                @endif
                                @foreach ($list['kups'] as $kups)
                                    <option value="{{ $kups->id }}">
                                        {{ $kups->kups_name }} - {{ $kups->ps_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="lembaga-kups">
                                Lembaga KUPS
                                @if (Auth::user()->roles_id == 2)
                                    <span class="text-danger fw-bold">*</span>
                                @endif
                            </label>

                            @error('lembaga_kups')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('program') is-invalid @enderror" name="program"
                                id="program" aria-label="Program" @if (Auth::user()->roles_id == 2) autofocus @endif>
                                <option value="" hidden>-</option>
                                @foreach ($list['programs'] as $program)
                                    <option value="{{ $program['id'] }}"
                                        @if (old('program') == $program['id']) {{ 'selected' }} @endif>
                                        {{ $program['program'] }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="program">Program <span class="text-danger fw-bold">*</span></label>

                            @error('program')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nama_pengusul') is-invalid @enderror"
                                name="nama_pengusul" id="nama-pengusul" placeholder="Nama Pengusul"
                                value="{{ old('nama_pengusul') }}">
                            <label for="nama-pengusul">Nama Pengusul <span class="text-danger fw-bold">*</span></label>

                            @error('nama_pengusul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('no_sp_proposal') is-invalid @enderror"
                                name="no_sp_proposal" id="nomor-sp" placeholder="Nomor Surat Permohonan"
                                value="{{ old('no_sp_proposal') }}">
                            <label for="nomor-sp">Nomor Surat Permohonan <span class="text-danger fw-bold">*</span></label>

                            @error('no_sp_proposal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('tgl_proposal') is-invalid @enderror"
                                name="tgl_proposal" id="tanggal-proposal" placeholder="Tanggal Pengajuan"
                                value="{{ old('tgl_proposal') }}">
                            <label for="tanggal-proposal">Tanggal Pengajuan <span
                                    class="text-danger fw-bold">*</span></label>

                            @error('tgl_proposal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" step="100" min="0"
                                class="form-control @error('budget_proposal') is-invalid @enderror" name="budget_proposal"
                                id="budget-proposal" placeholder="Usulan Anggaran" value="{{ old('budget_proposal') }}"
                                onblur="if(this.value < 0) this.value = 1"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="budget-proposal">Usulan Anggaran <span class="text-danger fw-bold">*</span></label>

                            @error('budget_proposal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="file-proposal" class="col-form-label">File Proposal</label>
                        <input class="form-control form-PS @error('proposal') is-invalid @enderror" type="file"
                            id="file-proposal" name="proposal">

                        @error('proposal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mt-3">
                        <label class="col-form-label">Lokasi Kegiatan</label>
                        <div id="map" class="form-PS"></div>
                        <input type="hidden" id="lat" name="latitude" value="">
                        <input type="hidden" id="lng" name="longitude" value="">
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('usulan') }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection

@section('page-js-script')
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.key') }}&callback=initMap" defer>
    </script>

    <script type="text/javascript">
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8.75,
                center: {
                    lat: 3.7308847,
                    lng: 116.7806015
                }
            });

            google.maps.event.addListenerOnce(map, "click", (event) => {
                addMarker(event.latLng, map);
                getLatLng(event);
            });
        }

        function getLatLng(event) {
            document.getElementById('lat').value = event.latLng.lat().toFixed(7);
            document.getElementById('lng').value = event.latLng.lng().toFixed(7);
        }

        function addMarker(location, map) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true,
            });

            marker.addListener('dragend', getLatLng);
        }
    </script>
@stop
