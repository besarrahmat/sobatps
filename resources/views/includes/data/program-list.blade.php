@extends('layouts.default')

@section('content')
    @include('includes.header')

    <section class="program-lists section-bg mt-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Daftar Program Perhutanan Sosial</h2>
            </div>

            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable-program">
                        <thead>
                            <tr>
                                <th scope="col no">#</th>
                                <th scope="col program">Nama Program</th>
                                <th scope="col status">Status</th>
                                <th scope="col total">Total Usulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($program_list as $program)
                                <tr>
                                    <td scope="row">
                                        {{ ++$i }}
                                    </td>
                                    <td>{{ $program['program'] }}</td>
                                    <td>
                                        @if ($program['status'] == 0)
                                            Ditutup
                                        @else
                                            Dibuka
                                        @endif
                                    </td>
                                    <td>{{ $program['total'] }}</td>
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
            $('.datatable-program').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [1, 3],
                }],
                "pageLength": 5,
                'scrollX': true,
            });
        });
    </script>
@stop
