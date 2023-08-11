@extends('layouts.dashboard')

@section('title', 'Edit Usulan Bantuan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Usulan {{ $usulan['proposal_sp_num'] }}</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('usulan/' . $usulan['id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi/Dipilih</span>

                    <div>
                        <div class="form-floating">
                            <select class="selectpicker form-select @error('lembaga_kups') is-invalid @enderror"
                                name="lembaga_kups" id="lembaga-kups" aria-label="Lembaga KUPS" disabled>
                                @foreach ($list['kups'] as $kups)
                                    <option value="{{ $kups->id }}">
                                        {{ $kups->kups_name }} - {{ $kups->ps_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="lembaga-kups">Lembaga KUPS</b></label>

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
                                id="program" aria-label="Program" autofocus>
                                @foreach ($list['programs'] as $program)
                                    <option value="{{ $program['id'] }}"
                                        @if (old('program', $usulan['program_id']) == $program['id']) {{ 'selected' }} @endif>
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
                                value="{{ old('nama_pengusul', $usulan['applicant_name']) }}" autofocus>
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
                                value="{{ old('no_sp_proposal', $usulan['proposal_sp_num']) }}">
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
                                value="{{ old('tgl_proposal', $usulan['proposal_date']) }}">
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
                                id="budget-proposal" placeholder="Usulan Anggaran"
                                value="{{ old('budget_proposal', $usulan['budget']) }}"
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

                    <div class="row-manual mt-3">
                        <label for="file-proposal" class="col-form-label">File Proposal</label>
                        <a class="link-file" href="{{ asset('storage/' . $usulan['proposal']) }}" target="_new"
                            @if ($usulan['proposal'] == null) hidden @endif>
                            <i class="bx bx-link-alt"></i>
                            Lihat Dokumen Awal
                        </a>
                        <input class="form-control @error('proposal') is-invalid @enderror" type="file"
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
                        <a href="{{ url('usulan/' . $usulan['id']) }}" class="btn btn-danger btn-delete">Batal</a>
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
        const latitude = parseFloat({!! json_encode($usulan['latitude']) !!});
        const longitude = parseFloat({!! json_encode($usulan['longitude']) !!});

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8.75,
                center: {
                    lat: 3.7308847,
                    lng: 116.7806015
                }
            });

            if (latitude && longitude) {
                addMarker({
                    lat: latitude,
                    lng: longitude
                }, map);

                map.setCenter({
                    lat: latitude,
                    lng: longitude
                });
            } else {
                google.maps.event.addListenerOnce(map, "click", (event) => {
                    addMarker(event.latLng, map);
                    getLatLng(event);
                });
            }
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
