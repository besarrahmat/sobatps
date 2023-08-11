@extends('layouts.dashboard')

@section('title', 'Rincian Bantuan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rincian Bantuan {{ $usulan['proposal_sp_num'] }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ url('usulan') }}" class="btn btn-primary btn-md rounded-0">
                                            <i class="bx bx-left-arrow-alt"></i>
                                        </a>
                                    </li>

                                    @if (Auth::user()->roles->code != 'admin' && $usulan['status'] !== 0)
                                        <li class="list-inline-item">
                                            <a class="btn btn-success btn-md rounded-0" type="button" title="Edit"
                                                href="{{ url('usulan/' . $usulan['id'] . '/edit') }}">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <form method="POST" action="{{ url('usulan/' . $usulan['id']) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-md rounded-0 show_confirm" type="submit"
                                                    title="Hapus">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>

                                @if (Auth::user()->roles->code == 'admin' && $usulan['status'] === null)
                                    <ul>
                                        <li class="list-inline-item">
                                            <form method="POST"
                                                action="{{ url('usulan/' . $usulan['id'] . '/open-close?status=' . 1) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-success btn-md rounded-0" type="submit">
                                                    Usulan Diterima
                                                </button>
                                            </form>
                                        </li>
                                        <li class="list-inline-item">
                                            <form method="POST"
                                                action="{{ url('usulan/' . $usulan['id'] . '/open-close?status=' . 0) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button class="btn btn-danger btn-md rounded-0" type="submit">
                                                    Usulan Ditolak
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                @endif
                            </div>

                            @if ($usulan['rab_total'] > $usulan['budget'])
                                <div class="card-message">
                                    <div class="card-header-message bg-danger">
                                        <h3 class="alert-heading">TOTAL ANGGARAN MELEBIHI USULAN ANGGARAN</h3>
                                        <h4 class="alert-heading">
                                            Anggaran melebihi Rp{{ $usulan['rab_total'] - $usulan['budget'] }}
                                        </h4>
                                    </div>
                                </div>
                            @endif

                            <!-- Table -->
                            <table class="table table-striped table-bordered detail-view mb-0">
                                <tbody>
                                    <tr>
                                        <th>Nama Pemohon Bantuan</th>
                                        <td>{{ $usulan['applicant_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Surat Permohonan</th>
                                        <td>{{ $usulan['proposal_sp_num'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $usulan['proposal_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usulan Anggaran</th>
                                        <td>{{ $usulan['budget'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Proyek</th>
                                        <td>
                                            @if ($usulan['status'] === 0)
                                                Ditolak
                                            @elseif ($usulan['status'] === 1)
                                                Diterima
                                            @else
                                                Belum Diputuskan
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <div class="btn-file mt-3 row justify-content-around">
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($usulan['proposal'] == null) hidden @endif>
                                    <a href="{{ asset('storage/' . $usulan['proposal']) }}" target="_new">
                                        Lihat File Proposal
                                    </a>
                                </button>
                            </div>

                            <div class="card-map mt-3">
                                <div class="card-header-map">
                                    <h3 class="card-title-map">Lokasi Kegiatan</h3>
                                </div>

                                <div class="card-body-map">
                                    <div id="map"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection

@section('page-js-script')
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.key') }}&callback=initMap" defer>
    </script>

    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus usulan ini?')) {
                e.preventDefault();
            }
        });

        function initMap() {
            const latitude = parseFloat({!! json_encode($usulan['latitude']) !!});
            const longitude = parseFloat({!! json_encode($usulan['longitude']) !!});

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8.75,
                center: {
                    lat: 3.7308847,
                    lng: 116.7806015
                }
            });

            if (latitude && longitude) {
                new google.maps.Marker({
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    map
                });

                map.setCenter({
                    lat: latitude,
                    lng: longitude
                });
            }
        }
    </script>
@stop
