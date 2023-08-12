@extends('layouts.default')

@section('content')
    @include('includes.header')

    <section class="permission-lists section-bg mt-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Daftar Izin Perhutanan Sosial</h2>
            </div>

            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable-lembaga">
                        <thead>
                            <tr>
                                <th scope="col no">#</th>
                                <th scope="col ps-name">Nama Lembaga</th>
                                <th scope="col area">Alamat</th>
                                <th scope="col sk-num">SK</th>
                                <th scope="col schema">Skema PS</th>
                                <th scope="col kups">KUPS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($ps_list as $ps)
                                <tr>
                                    <td scope="row">
                                        {{ ++$i }}
                                    </td>
                                    <td>{{ $ps['ps_name'] }}</td>
                                    <td>{{ $ps['address'] }}</td>
                                    <td>{{ $ps['ps_sk_num'] }}</td>
                                    <td>{{ $ps['type'] }}</td>
                                    <td>

                                        <!-- Small tables -->
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col no">#</th>
                                                    <th scope="col kups-name">Nama KUPS</th>
                                                    <th scope="col sk-num">Nomor SK</th>
                                                    <th scope="col type">Jenis Usaha</th>
                                                    <th scope="col comodity">Komoditas</th>
                                                    <th scope="col chief">Ketua KUPS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $j = 0; ?>
                                                @foreach ($ps['kups_list'] as $kups)
                                                    <tr>
                                                        <td scope="row">
                                                            {{ ++$j }}
                                                        </td>
                                                        <td>{{ $kups['kups_name'] }}</td>
                                                        <td>{{ $kups['kups_sk_num'] }}</td>
                                                        <td>{{ $kups['business_type'] }}</td>
                                                        <td>{{ $kups['comodity'] }}</td>
                                                        <td>{{ $kups['kups_chief'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- End small tables -->

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </section>
@endsection

@section('page-js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datatable-lembaga').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [1, 2, 3, 5],
                }],
                "pageLength": 5,
                'scrollX': true,
            });
        });
    </script>
@stop
