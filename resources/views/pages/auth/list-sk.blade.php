@extends('layouts.dashboard')

@section('title', 'Daftar SK Penerima Bantuan')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>SK Penerima Bantuan</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    @if (Auth::user()->roles->code == 'admin')
                        <a class="btn-add mt-1 mb-3" href="{{ url('list-sk/create') }}">
                            Tambah SK
                        </a>
                    @endif
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table sk-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no" style="width: 6%">#</th>
                                        <th scope="col year" style="width: 11%">Tahun</th>
                                        <th scope="col note">Keterangan</th>
                                        <th scope="col other" style="width: 13%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($sk_list as $sk)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>{{ $sk->tahun_sk }}</td>
                                            <td>{{ $sk->keterangan }}</td>
                                            <td>
                                                <ul class="list-inline m-0">
                                                    <li class="list-inline-item">
                                                        <a class="btn btn-warning btn-md rounded-0" type="button"
                                                            title="Tampilkan File"
                                                            href="{{ asset('storage/' . $sk->file_sk) }}" target="_new">
                                                            <i class="bx bx-file"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item"
                                                        @if (Auth::user()->roles->code != 'admin') hidden @endif>
                                                        <form method="POST" action="{{ url('list-sk/' . $sk->id) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger btn-md rounded-0 show_confirm"
                                                                type="submit" title="Hapus">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
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

@section('page-js-script')
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Apakah Anda yakin akan menghapus SK ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
