@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('produk_konsumsi')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Tambah @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produk_konsumsi.store') }}" method="POST">
                @csrf

                {{-- <div class="mb-3">
                    <label for="jenis_konsol_id" class="form-label">{{ str_replace('_', ' ', ucwords('jenis_konsol')) }}</label>
                    <select name="jenis_konsol_id" id="jenis_konsol_id" class="form-control @error('jenis_konsol_id') is-invalid @enderror">
                        <option value="" selected>-- pilih jenis_konsol --</option>
                        @foreach($jenis_konsols as $jenis_konsol)
                            <option value="{{ $jenis_konsol->id }}">{{ $jenis_konsol->nama }}</option>
                        @endforeach
                    </select>
                    @error('jenis_konsol_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="nama" class="form-label">{{ str_replace('_', ' ', ucwords('nama')) }}</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga_beli" class="form-label">{{ str_replace('_', ' ', ucwords('harga_beli')) }}</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror"
                           value="{{ old('harga_beli') }}" required>
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga_jual" class="form-label">{{ str_replace('_', ' ', ucwords('harga_jual')) }}</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror"
                           value="{{ old('harga_jual') }}" required>
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="poin" class="form-label">{{ str_replace('_', ' ', ucwords('poin')) }}</label>
                    <input type="number" name="poin" id="poin" class="form-control @error('poin') is-invalid @enderror"
                           value="{{ old('poin') }}" required>
                    @error('poin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('produk_konsumsi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
