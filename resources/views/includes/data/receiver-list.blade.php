@extends('layouts.default')

@section('content')
    @include('includes.header')

    <section class="receiver-lists section-bg mt-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Daftar Penerima Bantuan Perhutanan Sosial</h2>
            </div>

            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable-receiver">
                        <thead>
                            <tr>
                                <th scope="col no">#</th>
                                <th scope="col ps-name">Nama Lembaga</th>
                                <th scope="col area">Alamat</th>
                                <th scope="col sk-num">SK</th>
                                <th scope="col schema">Skema PS</th>
                                <th scope="col kups-name">Nama KUPS</th>
                                <th scope="col year">Tahun</th>
                                <th scope="col program">Program</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($receiver_list as $receiver)
                                <tr>
                                    <td scope="row">
                                        {{ ++$i }}
                                    </td>
                                    <td>{{ $receiver['ps_name'] }}</td>
                                    <td>{{ $receiver['address'] }}</td>
                                    <td>{{ $receiver['ps_sk_num'] }}</td>
                                    <td>{{ $receiver['type'] }}</td>
                                    <td>{{ $receiver['kups_name'] }}</td>
                                    <td>{{ $receiver['proposal_year'] }}</td>
                                    <td>{{ $receiver['program'] }}</td>
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
            $('.datatable-receiver').DataTable({
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
