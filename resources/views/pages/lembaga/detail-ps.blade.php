@extends('layouts.dashboard')

@section('title', $ps['ps_name'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $ps['ps_name'] }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ url('lembaga-ps') }}" class="btn btn-primary btn-md rounded-0">
                                        <i class="bx bx-left-arrow-alt"></i>
                                    </a>
                                </li>

                                @if (Auth::user()->roles->code == 'admin')
                                    <li class="list-inline-item">
                                        <a class="btn btn-success btn-md rounded-0" type="button" title="Edit"
                                            href="{{ url('lembaga-ps/' . $ps['id'] . '/edit') }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form method="POST" action="{{ url('lembaga-ps/' . $ps['id']) }}">
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

                            <!-- Table -->
                            <table class="table table-striped table-bordered detail-view mb-0">
                                <tbody>
                                    <tr>
                                        <th>Nama Lembaga PS</th>
                                        <td>{{ $ps['ps_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>KD Jenis PS</th>
                                        <td>{{ $ps['ps_type_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>KD Kab/Kota</th>
                                        <td>{{ $ps['kab_kota'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>KD Kecamatan</th>
                                        <td>{{ $ps['kecamatan'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>KD Desa</th>
                                        <td>{{ $ps['region_code'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor SK</th>
                                        <td>{{ $ps['ps_sk_num'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal SK</th>
                                        <td>{{ $ps['ps_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Luas SK</th>
                                        <td>{{ $ps['area'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ketua</th>
                                        <td>{{ $ps['ps_chief'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah KK</th>
                                        <td>{{ $ps['kk_total'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fungsi Kawasan</th>
                                        <td>{{ $ps['area_function'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Kontak</th>
                                        <td>{{ $ps['ps_contact'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <div class="btn-file mt-3 row justify-content-around">
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($ps['sk_file'] == null) hidden @endif>
                                    <a href="{{ asset('berkas/' . $ps['sk_file']) }}" target="_new">
                                        Lihat File SK
                                    </a>
                                </button>
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($ps['rku_file'] == null) hidden @endif>
                                    <a href="{{ asset('berkas/' . $ps['rku_file']) }}" target="_new">
                                        Lihat File RKU
                                    </a>
                                </button>
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($ps['rkt_file'] == null) hidden @endif>
                                    <a href="{{ asset('berkas/' . $ps['rkt_file']) }}" target="_new">
                                        Lihat File RKT
                                    </a>
                                </button>
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($ps['shp_file'] == null) hidden @endif>
                                    <a href="{{ asset('berkas/' . $ps['shp_file']) }}" target="_new">
                                        Lihat File SHP
                                    </a>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection

@section('page-js-script')
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus lembaga ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
