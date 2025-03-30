@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('konsol')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Tambah @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('konsol.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">{{ str_replace('_', ' ', ucwords('supplier')) }}</label>
                    <select name="supplier_id" id="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                        <option value="" selected>-- pilih supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                    <label for="firmware_id" class="form-label">{{ str_replace('_', ' ', ucwords('firmware')) }}</label>
                    <select name="firmware_id" id="firmware_id" class="form-control @error('firmware_id') is-invalid @enderror">
                        <option value="" selected>-- pilih firmware --</option>
                        @foreach($firmwares as $firmware)
                            <option value="{{ $firmware->id }}">{{ $firmware->nama }}</option>
                        @endforeach
                    </select>
                    @error('firmware_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="seri" class="form-label">{{ str_replace('_', ' ', ucwords('seri')) }}</label>
                    <input type="text" name="seri" id="seri" class="form-control @error('seri') is-invalid @enderror"
                           value="{{ old('seri') }}" required>
                    @error('seri')
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
                    <label for="tanggal_kedatangan" class="form-label">{{ str_replace('_', ' ', ucwords('tanggal_kedatangan')) }}</label>
                    <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control @error('tanggal_kedatangan') is-invalid @enderror"
                           value="{{ old('tanggal_kedatangan') }}" required>
                    @error('tanggal_kedatangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ str_replace('_', ' ', ucwords('status')) }}</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        @php
                            $statusOptions = ['normal', 'disewa keluar', 'perbaikan', 'rusak', 'dijual'];
                        @endphp
                        <option value="" selected>-- pilih status --</option>
                        @foreach($statusOptions as $option)
                            <option value="{{ $option }}" {{ old('status', $konsol->status ?? '') == $option ? 'selected' : '' }}>
                                {{ ucwords($option) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('konsol.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
