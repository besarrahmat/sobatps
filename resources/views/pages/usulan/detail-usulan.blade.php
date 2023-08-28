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
                                    <a href="{{ asset('berkas/' . $usulan['proposal']) }}" target="_new">
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

                            @if ($usulan['status'] == 1)
                                <div class="card-rab mb-0">
                                    <div class="card-header-rab">
                                        <h3 class="card-title-rab">Rincian Anggaran dan Biaya Kegiatan</h3>
                                    </div>

                                    <div class="card-body-rab">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col no">#</th>
                                                    <th scope="col name" style="width: 45%">Barang</th>
                                                    <th scope="col amount">Banyak</th>
                                                    <th scope="col unit">Satuan</th>
                                                    <th scope="col price">Harga</th>
                                                    <th scope="col total">Jumlah</th>
                                                    <th scope="col other" style="width: 10%"
                                                        @if (Auth::user()->roles->code == 'admin' || count($usulan['rab']) === 0) hidden @endif></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($usulan['rab'] as $rab)
                                                    <tr data-key="0">
                                                        <td scope="row">
                                                            <?php
                                                            echo $i;
                                                            $i++;
                                                            ?>
                                                        </td>
                                                        <td>{{ $rab['goods'] }}</td>
                                                        <td>{{ $rab['amount'] }}</td>
                                                        <td>{{ $rab['unit'] }}</td>
                                                        <td>{{ $rab['price'] }}</td>
                                                        <td>{{ $rab['total'] }}</td>
                                                        <td @if (Auth::user()->roles->code == 'admin') hidden @endif>
                                                            <ul class="list-inline m-0">
                                                                @if (Auth::user()->roles->code != 'admin')
                                                                    <li class="list-inline-item">
                                                                        <a class="btn btn-success btn-md rounded-0"
                                                                            type="button" title="Edit"
                                                                            href="{{ url('rab/' . $rab['id'] . '/edit') }}">
                                                                            <i class="bx bx-edit"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <form method="POST"
                                                                            action="{{ url('rab/' . $rab['id']) }}">
                                                                            @csrf
                                                                            @method('DELETE')

                                                                            <button
                                                                                class="btn btn-danger btn-md rounded-0 show_confirm_rab"
                                                                                type="submit" title="Hapus">
                                                                                <i class="bx bx-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if (Auth::user()->roles->code != 'admin')
                                            <div class="d-flex justify-content-center">
                                                <a class="btn-add"
                                                    href="{{ url('rab/create?usulan_id=' . $usulan['id']) }}">
                                                    Tambah Anggaran
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    @if ($usulan['status'] == 1)
                        <div class="card">
                            <div class="card-body pb-0">

                                <div class="card-additional-title mb-4">
                                    <h2>Kelengkapan Usulan</h2>
                                    <p>Berikut ini adalah kelengkapan usulan bantuan perhutanan sosial anda</p>
                                </div>

                                @if (Auth::user()->roles->code != 'admin')
                                    <div class="d-flex justify-content-center mb-4">
                                        <a class="btn btn-primary w-100 py-3"
                                            href="{{ url('kelengkapan/create?usulan_id=' . $usulan['id']) }}">
                                            Tambah Kelengkapan
                                        </a>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">

                                        @foreach ($usulan['extra_list'] as $extra)
                                            <div class="card-additional">
                                                <div class="card-header-additional"
                                                    @if ($extra['is_file_exist']) @if ($extra['approval'] == 1)
																								style="background-color: #4ad469"
																								@elseif ($extra['approval'] == 0)
																								style="background-color: #f9c105" @endif
                                                    @endif>
                                                    <h3 class="card-title-additional">{{ $extra['jenis'] }}</h3>
                                                </div>

                                                <div class="card-body-additional">
                                                    {!! $extra['deskripsi'] !!}
                                                </div>

                                                <div class="card-footer-additional row g-3">
                                                    <div class="col-6">
                                                        <div class="identitas mb-3 d-flex align-items-center">
                                                            <img src="{{ asset('assets/img/profile-img.jpg') }}"
                                                                alt="Profile" class="rounded-circle ">
                                                            <span class="d-md-block ps-2 username">Pengusul</span>
                                                            &nbsp;
                                                            {{ $extra['tanggal'] }}
                                                        </div>

                                                        <div class="catatan mt-2 mb-2">
                                                            <b>Catatan Pengusul</b>
                                                            <br>
                                                            {{ $extra['catatan'] }}
                                                        </div>

                                                        @if (!$extra['is_file_exist'])
                                                            Belum unggah file
                                                        @else
                                                            <div class="row g-3">
                                                                @foreach ($extra['file_list'] as $file)
                                                                    <div class="col-6">
                                                                        <div class="link-file">
                                                                            <a href="{{ asset('berkas/' . $file['file']) }}"
                                                                                target="_new">
                                                                                <i class="bx bx-link-alt"></i>
                                                                                Lihat Dokumen
                                                                            </a>
                                                                            @if ($file['approval'] == 1)
                                                                                &nbsp;&nbsp;&nbsp;
                                                                                <i class="bx bx-check-circle"></i>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        @if (Auth::user()->roles->code != 'admin')
                                                                            <div class="d-flex justify-content-center">
                                                                                <a class="btn btn-add btn-success btn-md"
                                                                                    title="Update"
                                                                                    href="{{ url('kelengkapan/' . $file['id'] . '/edit?tipe=' . $extra['id']) }}">
                                                                                    <i class="bx bx-edit"></i>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="identitas mb-3 d-flex align-items-center">
                                                            <img src="{{ asset('assets/img/kaltara.png') }}"
                                                                alt="Dinas">
                                                            <span class="d-md-block ps-2 username">Dinas Perhutanan</span>
                                                        </div>

                                                        <input type="hidden" id="approval"
                                                            value="{{ $extra['approval'] }}">

                                                        <div class="catatan mt-2 mb-2">
                                                            <b>Catatan Pemeriksa</b>
                                                            <br>
                                                            {{ $extra['note'] }}
                                                        </div>

                                                        @if (Auth::user()->roles->code == 'admin' && isset($extra['approve_id']))
                                                            <div class="d-flex justify-content-center">
                                                                <a class="btn-add"
                                                                    href="{{ url('kelengkapan/' . $extra['approve_id'] . '/pending?tipe=' . $extra['id']) }}">
                                                                    Berikan Catatan Asistensi
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">

                                <div class="card-progress-title mb-4">
                                    <h2>Progress Kegiatan</h2>
                                    <p>Berikut ini adalah daftar progress kegiatan anda</p>
                                </div>

                                @if (Auth::user()->roles->code != 'admin')
                                    <div class="d-flex justify-content-center mb-4">
                                        <a class="btn btn-primary w-100 py-3"
                                            href="{{ url('progress/create?usulan_id=' . $usulan['id']) }}">
                                            Tambah Progress Kegiatan
                                        </a>
                                    </div>
                                @endif

                                <div class="card-progress-body">
                                    <table class="table table-striped table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col no">#</th>
                                                <th scope="col date">Tanggal</th>
                                                <th scope="col activity" style="width: 55%">Aktivitas</th>
                                                <th scope="col doc">Dokumentasi</th>
                                                <th class="action-column" @if ($usulan['approval']) hidden @endif>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($usulan['progress'] as $progress)
                                                <tr data-key="0">
                                                    <td scope="row">
                                                        {{ ++$i }}
                                                    </td>
                                                    <td>{{ $progress['date'] }}</td>
                                                    <td>{{ $progress['activity'] }}</td>
                                                    <td>
                                                        <div class="mb-3 link-file">
                                                            <a href="{{ asset('berkas/' . $progress['documentation']) }}"
                                                                target="_new">
                                                                <i class="bx bx-link-alt"></i>
                                                                Lihat Dokumentasi
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td @if ($usulan['approval']) hidden @endif>
                                                        @if ($progress['approval'] === 0)
                                                            <ul class="list-inline m-0">
                                                                @if (Auth::user()->roles->code != 'admin')
                                                                    <li class="list-inline-item">
                                                                        <a class="btn btn-success btn-md rounded-0"
                                                                            type="button" title="Edit"
                                                                            href="{{ url('progress/' . $progress['id'] . '/edit') }}">
                                                                            <i class="bx bx-edit"></i>
                                                                        </a>
                                                                    </li>

                                                                    <li class="list-inline-item">
                                                                        <form method="POST"
                                                                            action="{{ url('progress/' . $progress['id']) }}">
                                                                            @csrf
                                                                            @method('DELETE')

                                                                            <button
                                                                                class="btn btn-danger btn-md rounded-0 show_confirm_progress"
                                                                                type="submit" title="Hapus">
                                                                                <i class="bx bx-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                @endif

                                                                @if (Auth::user()->roles->code == 'admin')
                                                                    <div>
                                                                        <form method="POST"
                                                                            action="{{ url('progress/' . $progress['id'] . '/approve') }}">
                                                                            @csrf
                                                                            @method('PATCH')

                                                                            <button
                                                                                class="btn btn-warning btn-md rounded-0"
                                                                                type="submit">
                                                                                Disetujui
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </ul>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    @endif

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

        $('.show_confirm_rab').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus anggaran ini?')) {
                e.preventDefault();
            }
        });

        $('.show_confirm_progress').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus progress ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
