@extends('layouts.dashboard')

@section('title', 'Tambah RAB')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah RAB</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">

                <!-- Floating Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('rab') }}">
                    @csrf

                    <span class="text-danger fw-bold mt-0">* Wajib Diisi</span>

                    <input type="hidden" id="usulan_id" name="usulan_id" value="{{ $usulan_id }}">

                    <div class="col-lg-6 col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('barang') is-invalid @enderror" name="barang"
                                id="barang" placeholder="Nama Barang" value="{{ old('barang') }}" autofocus>
                            <label for="barang">Nama Barang <span class="text-danger fw-bold">*</span></label>

                            @error('barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <div class="form-floating">
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('banyak') is-invalid @enderror" name="banyak" id="banyak"
                                placeholder="Banyak" value="{{ old('banyak') }}"
                                onblur="if(this.value < 0) this.value = 1; this.value = parseFloat(this.value).toFixed(2);"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46))">
                            <label for="banyak">Banyak <span class="text-danger fw-bold">*</span></label>

                            @error('banyak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan"
                                id="satuan" placeholder="Satuan" value="{{ old('satuan') }}">
                            <label for="satuan">Satuan</label>

                            @error('satuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <div class="form-floating">
                            <input type="number" step="10" min="0"
                                class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga"
                                placeholder="Harga" value="{{ old('harga') }}" onblur="if(this.value < 0) this.value = 1;"
                                onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <label for="harga">Harga <span class="text-danger fw-bold">*</span></label>

                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success btn-add">Simpan</button>
                        <a href="{{ url('usulan/' . $usulan_id) }}" class="btn btn-danger btn-delete">Batal</a>
                    </div>
                </form>
                <!-- End Floating Labels Form -->

            </div>
        </div>

    </main>
@endsection
