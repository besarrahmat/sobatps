@extends('layouts.dashboard')

@section('title', $program['program'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $program['program'] }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ url('program') }}" class="btn btn-primary btn-md rounded-0">
                                            <i class="bx bx-left-arrow-alt"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-success btn-md rounded-0" type="button" title="Edit"
                                            href="{{ url('program/' . $program['id'] . '/edit') }}">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item" @if ($program['status'] == 1) hidden @endif>
                                        <form method="POST" action="{{ url('program/' . $program['id']) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-md rounded-0 show_confirm" type="submit"
                                                title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-secondary btn-md rounded-0" type="button"
                                            href="{{ url('program/' . $program['id'] . '/pendaftar') }}">
                                            Lihat Pendaftar
                                            <i class="bx bx-right-arrow-alt"></i>
                                        </a>
                                    </li>
                                </ul>

                                <ul>
                                    <li class="list-inline-item">
                                        <form method="POST"
                                            action="{{ url('program/' . $program['id'] . '/open-close') }}">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-open-close btn-md rounded-0" type="submit">
                                                @if ($program['status'] == 0)
                                                    Buka Program
                                                @else
                                                    Tutup Program
                                                @endif
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <!-- Table -->
                            <table class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr>
                                        <th>Tanggal Mulai</th>
                                        <td>{{ $program['start_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Selesai</th>
                                        <td>{{ $program['end_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor</th>
                                        <td>{{ $program['program_num'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal KAK</th>
                                        <td>{{ $program['kak_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alokasi Anggaran</th>
                                        <td>{{ $program['budget_allocation'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Program</th>
                                        <td>
                                            @if ($program['status'] == 0)
                                                Ditutup
                                            @else
                                                Dibuka
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <div class="btn-file row justify-content-around">
                                <button class="btn btn-warning collapsed col-2" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                    @if ($program['kak_file'] == null) hidden @endif>
                                    <a href="{{ asset('storage/' . $program['kak_file']) }}" target="_new">
                                        Lihat File KAK
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
            if (!confirm('Apakah Anda yakin akan menghapus program ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
