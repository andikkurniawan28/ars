@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('produk_rental')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Tambah @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produk_rental.store') }}" method="POST">
                @csrf

                <div class="mb-3">
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
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">{{ str_replace('_', ' ', ucwords('nama')) }}</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="durasi" class="form-label">{{ str_replace('_', ' ', ucwords('durasi')) }}</label>
                    <input type="number" name="durasi" id="durasi" class="form-control @error('durasi') is-invalid @enderror"
                           value="{{ old('durasi') }}" required>
                    @error('durasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">{{ str_replace('_', ' ', ucwords('harga')) }}</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga') }}" required>
                    @error('harga')
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
                    <a href="{{ route('produk_rental.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
