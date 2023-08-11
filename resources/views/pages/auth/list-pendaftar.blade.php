@extends('layouts.dashboard')

@section('title', $program['program'])

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $program['program'] }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    <a class="btn btn-add btn-secondary rounded-0 mt-1 mb-3" type="button"
                        href="{{ url('program/' . $program['id']) }}">
                        <i class="bx bx-left-arrow-alt"></i>
                        Kembali Ke Informasi Program
                    </a>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table pendaftar-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col kups">KUPS</th>
                                        <th scope="col name">Nama Pengusul</th>
                                        <th scope="col num">Nomor</th>
                                        <th scope="col status">Status Usulan</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($list as $pendaftar)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>{{ $pendaftar['kups_name'] }}</td>
                                            <td>{{ $pendaftar['applicant_name'] }}</td>
                                            <td>{{ $pendaftar['proposal_sp_num'] }}</td>
                                            <td>
                                                @if ($pendaftar['status'] === 0)
                                                    Ditolak
                                                @elseif ($pendaftar['status'] === 1)
                                                    Diterima
                                                @else
                                                    Belum Diputuskan
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                    href="{{ url('usulan/' . $pendaftar['id']) }}">
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
