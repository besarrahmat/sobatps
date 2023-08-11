@extends('layouts.dashboard')

@section('title', 'Daftar User')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>User</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    <a class="btn-add mt-1 mb-3" href="{{ url('user/create') }}">Tambah User</a>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table user-datatable">
                                <thead>
                                    <tr>
                                        <th scope="col name">Nama</th>
                                        <th scope="col email">E-mail</th>
                                        <th scope="col roles">Roles</th>
                                        <th scope="col other" style="width: 13%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_list as $user)
                                        <tr>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['role'] }}</td>
                                            <td>
                                                <ul class="list-inline m-0">
                                                    <li class="list-inline-item">
                                                        <a class="btn btn-success btn-md rounded-0" type="button"
                                                            title="Edit"
                                                            href="{{ url('user/' . $user['id'] . '/edit') }}">
                                                            <i class="bx bx-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form method="POST" action="{{ url('user/' . $user['id']) }}">
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
            if (!confirm('Apakah Anda yakin akan menghapus akun ini?')) {
                e.preventDefault();
            }
        });
    </script>
@stop
