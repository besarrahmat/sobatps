@extends('layouts.dashboard')

@section('title', $kups['kups_name'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $kups['kups_name'] }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ url('lembaga-kups') }}" class="btn btn-primary btn-md rounded-0">
                                        <i class="bx bx-left-arrow-alt"></i>
                                    </a>
                                </li>

                                @if (Auth::user()->roles->code == 'admin' || Auth::user()->roles->code == 'helper')
                                    <li class="list-inline-item">
                                        <a class="btn btn-success btn-md rounded-0" type="button" title="Edit"
                                            href="{{ url('lembaga-kups/' . $kups['id'] . '/edit') }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form method="POST" action="{{ url('lembaga-kups/' . $kups['id']) }}">
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
                                        <th>KD Lembaga PS</th>
                                        <td>{{ $kups['ps_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lembaga KUPS</th>
                                        <td>{{ $kups['kups_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor SK</th>
                                        <td>{{ $kups['kups_sk_num'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Usaha</th>
                                        <td>{{ $kups['business_type'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Komoditas</th>
                                        <td>{{ $kups['comodity'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Kelas</th>
                                        <td>
                                            @switch($kups['class'])
                                                @case(1)
                                                    Platinum
                                                @break

                                                @case(2)
                                                    Gold
                                                @break

                                                @case(3)
                                                    Silver
                                                @break

                                                @case(4)
                                                    Blue
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ketua</th>
                                        <td>{{ $kups['kups_chief'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Kontak</th>
                                        <td>{{ $kups['kups_contact'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table -->
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
