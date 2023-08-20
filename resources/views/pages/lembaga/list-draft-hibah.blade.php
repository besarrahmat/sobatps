@extends('layouts.dashboard')

@section('title', 'Daftar Usulan Calon Penerima Hibah')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Usulan Calon Penerima Hibah</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    @if (Auth::user()->roles->code == 'helper')
                        <a class="btn-add mt-1 mb-3" href="{{ url('draft-hibah/create') }}">
                            Tambah Calon Penerima Hibah
                        </a>
                    @endif
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table hibah-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col no" style="width: 6%">#</th>
                                        <th scope="col name">Pendamping</th>
                                        <th scope="col kups">KUPS</th>
                                        <th scope="col date">Tanggal</th>
                                        <th scope="col file">File</th>
                                        <th scope="col approve" style="width: 13%">
                                            @if ($check != null || Auth::user()->roles->code != 'admin')
                                                Disetujui?
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($hibah_list as $hibah)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$i }}
                                            </td>
                                            <td>
                                                @if ($hibah->is_exist_name === false)
                                                    <s>{{ $hibah->edited_name }}</s>
                                                @else
                                                    {{ $hibah->edited_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($hibah->is_exist_kups === false)
                                                    <s>{{ $hibah->deleted_kups }}</s>
                                                @else
                                                    {{ $hibah->deleted_kups }}
                                                @endif
                                            </td>
                                            <td>{{ $hibah->tanggal_sk }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-md rounded-0" type="button"
                                                    title="Tampilkan File" href="{{ asset('berkas/' . $hibah->file_sk) }}"
                                                    target="_new">
                                                    <i class="bx bx-file"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if (Auth::user()->roles->code != 'admin')
                                                    @if ($hibah->approval == 1)
                                                        <i class="bx bx-check approval yes"></i>
                                                    @else
                                                        <i class="bx bx-x approval no"></i>
                                                    @endif
                                                @else
                                                    @if ($hibah->approval != 1)
                                                        <form method="POST"
                                                            action="{{ url('draft-hibah/' . $hibah->id . '/approve') }}">
                                                            @csrf
                                                            @method('PATCH')

                                                            <button class="btn btn-success btn-md rounded-0" type="submit">
                                                                Ya
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
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
