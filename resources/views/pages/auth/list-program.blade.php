@extends('layouts.dashboard')

@section('title', 'Daftar Tawaran Proposal')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Program</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    <a class="btn-add mt-1 mb-3" href="{{ url('program/create') }}">Tambah Tawaran Proposal</a>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table program-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col name">Nama Kegiatan Bantuan</th>
                                        <th scope="col start">Tanggal Mulai</th>
                                        <th scope="col end">Tanggal Selesai</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($program_list as $program)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>{{ $program['program'] }}</td>
                                            <td>{{ $program['start_date'] }}</td>
                                            <td>{{ $program['end_date'] }}</td>
                                            <td>
                                                <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                    href="{{ url('program/' . $program['id']) }}">
                                                    <i class="bx bx-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
