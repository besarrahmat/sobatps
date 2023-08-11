@extends('layouts.dashboard')

@section('title', 'Daftar Lembaga KUPS')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Lembaga KUPS</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    @if (Auth::user()->roles->code == 'admin' || Auth::user()->roles->code == 'helper')
                        <a class="btn-add mt-1 mb-3" href="{{ url('lembaga-kups/create') }}">
                            Tambah Lembaga KUPS
                        </a>
                    @endif
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <script type="text/javascript">
                                window.role = "{{ $role }}";
                            </script>

                            <!-- Table with stripped rows -->
                            <table class="table kups-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col name">Nama Lembaga</th>
                                        <th scope="col name-kups">Nama KUPS</th>
                                        <th scope="col no-sk">Nomor SK</th>
                                        <th scope="col chief">Ketua KUPS</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($kups_list as $kups)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>{{ $kups->ps_name }}</td>
                                            <td>{{ $kups->kups_name }}</td>
                                            <td>{{ $kups->kups_sk_num }}</td>
                                            <td>{{ $kups->kups_chief }}</td>
                                            <td>
                                                <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                    href="{{ url('lembaga-kups/' . $kups->id) }}">
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
