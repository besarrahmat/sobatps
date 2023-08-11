@extends('layouts.dashboard')

@section('title', 'Edit Jenis Asistensi')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Jenis Asistensi</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('extra/' . $extra->id) }}">
                    @csrf
                    @method('PATCH')

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                                id="nama-master" placeholder="Jenis Kelengkapan" value="{{ old('jenis', $extra->jenis) }}"
                                autofocus>
                            <label for="nama-master">Jenis Kelengkapan <span class="text-danger fw-bold">*</span></label>

                            @error('jenis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" step="1" class="form-control @error('urutan') is-invalid @enderror"
                                name="urutan" id="urutan" placeholder="Urutan"
                                value="{{ old('urutan', $extra->urutan) }}">
                            <label for="urutan">Urutan <span class="text-danger fw-bold">*</span></label>

                            @error('urutan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="deskripsi" class="deskripsi m-3">Deskripsi <span
                                class="text-danger fw-bold">*</span></label>
                        <textarea class="tinymce-editor @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">{{ old('deskripsi', $extra->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('extra/' . $extra->id) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection

@section('page-js-script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            menubar: false,
            plugins: 'lists pagebreak link table code quickbars',
            toolbar: 'undo redo | styles bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | pagebreak link table | code',
            lists_indent_on_tab: true,
            pagebreak_split_block: true,
            link_default_target: '_blank',
            table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            quickbars_insert_toolbar: false,
            quickbars_selection_toolbar: 'bold italic underline',
            quickbars_image_toolbar: false,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
@stop
