@extends('layouts.dashboard')

@section('title', 'Daftar Usulan Bantuan Anda')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Usulan Bantuan Anda</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    @if (Auth::user()->roles->code != 'admin' && Auth::user()->roles->code != 'null' && $kosong == false)
                        <a class="btn-add mt-1 mb-3" href="{{ url('usulan/create') }}">Tambah Usulan</a>
                    @endif
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table usulan-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col name" class="wrap">Program</th>
                                        <th scope="col applicant">Nama Pemohon</th>
                                        <th scope="col date">Tanggal</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Auth::user()->roles->code != 'null')
                                        <?php $i = 0; ?>
                                        @foreach ($usulan_list as $usulan)
                                            <tr>
                                                <td scope="row">
                                                    {{ ++$i }}
                                                </td>
                                                <td>{{ $usulan->program }}</td>
                                                <td>{{ $usulan->applicant_name }}</td>
                                                <td>{{ $usulan->proposal_date }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                        href="{{ url('usulan/' . $usulan->id) }}">
                                                        <i class="bx bx-info-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
