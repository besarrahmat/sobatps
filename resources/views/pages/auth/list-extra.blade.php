@extends('layouts.dashboard')

@section('title', 'Master Jenis Asistensi')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Master Jenis Asistensi</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    <a class="btn-add mt-1 mb-3" href="{{ url('extra/create') }}">Tambah Jenis Asistensi</a>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table extra-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col name">Jenis Kelengkapan</th>
                                        <th scope="col start">Deskripsi</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extra_list as $extra)
                                        <tr>
                                            <td scope="row">
                                                {{ $extra->urutan }}
                                            </td>
                                            <td>{{ $extra->jenis }}</td>
                                            <td>{{ $extra->deskripsi }}</td>
                                            <td>
                                                <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                    href="{{ url('extra/' . $extra->id) }}">
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
