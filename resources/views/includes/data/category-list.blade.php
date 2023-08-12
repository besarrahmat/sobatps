@extends('layouts.default')

@section('content')
    @include('includes.header')

    <section class="category-lists section-bg mt-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Daftar Kategori Kelas KUPS</h2>
            </div>

            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable-category">
                        <thead>
                            <tr>
                                <th scope="col no">#</th>
                                <th scope="col ps-name">Nama Lembaga</th>
                                <th scope="col area">Alamat</th>
                                <th scope="col schema">Skema PS</th>
                                <th scope="col kups">KUPS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($category_list as $ps)
                                <tr>
                                    <td scope="row">
                                        {{ ++$i }}
                                    </td>
                                    <td>{{ $ps['ps_name'] }}</td>
                                    <td>{{ $ps['address'] }}</td>
                                    <td>{{ $ps['type'] }}</td>
                                    <td>

                                        <!-- Small tables -->
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col no">#</th>
                                                    <th scope="col kups-name">Nama KUPS</th>
                                                    <th scope="col category">Kategori Kelas</th>
                                                    <th scope="col comodity">Komoditas Unggulan</th>
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
                                                        <td>{{ $kups['class'] }}</td>
                                                        <td>{{ $kups['comodity'] }}</td>
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
            $('.datatable-category').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [1, 2],
                }],
                "pageLength": 5,
                'scrollX': true,
            });
        });
    </script>
@stop
