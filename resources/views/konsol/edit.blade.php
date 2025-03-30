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
            <h4 class="m-0 font-weight-bold text-primary">Edit @yield('title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('konsol.update', $konsol->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                        <option value="" selected>-- pilih supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $konsol->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_konsol_id" class="form-label">Jenis Konsol</label>
                    <select name="jenis_konsol_id" id="jenis_konsol_id" class="form-control @error('jenis_konsol_id') is-invalid @enderror">
                        <option value="" selected>-- pilih jenis konsol --</option>
                        @foreach($jenis_konsols as $jenis_konsol)
                            <option value="{{ $jenis_konsol->id }}" {{ $konsol->jenis_konsol_id == $jenis_konsol->id ? 'selected' : '' }}>
                                {{ $jenis_konsol->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_konsol_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="firmware_id" class="form-label">Firmware</label>
                    <select name="firmware_id" id="firmware_id" class="form-control @error('firmware_id') is-invalid @enderror">
                        <option value="" selected>-- pilih firmware --</option>
                        @foreach($firmwares as $firmware)
                            <option value="{{ $firmware->id }}" {{ $konsol->firmware_id == $firmware->id ? 'selected' : '' }}>
                                {{ $firmware->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('firmware_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="seri" class="form-label">Seri</label>
                    <input type="text" name="seri" id="seri" class="form-control @error('seri') is-invalid @enderror"
                           value="{{ old('seri', $konsol->seri) }}" required>
                    @error('seri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga', $konsol->harga) }}" required>
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_kedatangan" class="form-label">Tanggal Kedatangan</label>
                    <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control @error('tanggal_kedatangan') is-invalid @enderror"
                           value="{{ old('tanggal_kedatangan', $konsol->tanggal_kedatangan) }}" required>
                    @error('tanggal_kedatangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        @php
                            $statusOptions = ['normal', 'disewa keluar', 'perbaikan', 'rusak', 'dijual'];
                        @endphp
                        <option value="" selected>-- pilih status --</option>
                        @foreach($statusOptions as $option)
                            <option value="{{ $option }}" {{ old('status', $konsol->status) == $option ? 'selected' : '' }}>
                                {{ ucwords($option) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
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
