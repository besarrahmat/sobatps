@extends('layouts.dashboard')

@section('title', 'Detail Jenis Asistensi')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Jenis Asistensi</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ url('extra') }}" class="btn btn-primary btn-md rounded-0">
                                        <i class="bx bx-left-arrow-alt"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-success btn-md rounded-0" type="button" title="Edit"
                                        href="{{ url('extra/' . $extra->id . '/edit') }}">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <form method="POST" action="{{ url('extra/' . $extra->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-md rounded-0 show_confirm" type="submit"
                                            title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </li>
                            </ul>

                            <div class="card-additional mt-3 mb-0">
                                <div class="card-header-additional">
                                    <h3 class="card-title-additional">{{ $extra->jenis }}</h3>
                                </div>

                                <div class="card-body-additional">
                                    {!! $extra->deskripsi !!}
                                </div>

                                <div class="card-footer-additional row g-3">
                                    <div class="col-6">
                                        <div class="identitas mb-3 d-flex align-items-center">
                                            <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile"
                                                class="rounded-circle ">
                                            <span class="d-md-block ps-2 username">Pengusul</span>
                                            &nbsp;
                                            (tanggal)
                                        </div>

                                        <div class="catatan mt-2 mb-2">
                                            <b>Catatan Pengusul</b>
                                            <br>
                                            (catatan)
                                        </div>

                                        <div class="mb-3 link-file">
                                            <i class="bx bx-link-alt"></i>
                                            (file)
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <div class="btn-add">
                                                Perbarui File
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="identitas mb-3 d-flex align-items-center">
                                            <img src="{{ asset('assets/img/kaltara.png') }}" alt="Dinas">
                                            <span class="d-md-block ps-2 username">Dinas Perhutanan</span>
                                        </div>

                                        <div class="catatan mt-2 mb-2">
                                            <b>Catatan Pemeriksa</b>
                                            <br>
                                            (catatan)
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <div class="btn-add">
                                                Berikan Catatan Asistensi
                                            </div>
                                        </div>
                                    </div>
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
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus master ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
