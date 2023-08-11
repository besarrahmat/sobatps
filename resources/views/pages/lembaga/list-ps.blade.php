@extends('layouts.dashboard')

@section('title', 'Daftar Lembaga PS')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Lembaga PS</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    @if (Auth::user()->roles->code == 'admin')
                        <a class="btn-add mt-1 mb-3" href="{{ url('lembaga-ps/create') }}">
                            Tambah Lembaga PS
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
                            <table class="table ps-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no">#</th>
                                        <th scope="col name">Nama Lembaga</th>
                                        <th scope="col no-sk">Nomor SK</th>
                                        <th scope="col area">Luas SK</th>
                                        <th scope="col chief">Nama Ketua</th>
                                        <th scope="col other" style="width: 7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($ps_list as $ps)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>{{ $ps->ps_name }}</td>
                                            <td>{{ $ps->ps_sk_num }}</td>
                                            <td>{{ $ps->area }}</td>
                                            <td>{{ $ps->ps_chief }}</td>
                                            <td>
                                                <a class="btn btn-info btn-md rounded-0" type="button" title="Detail"
                                                    href="{{ url('lembaga-ps/' . $ps->id) }}">
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
