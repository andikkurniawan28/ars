@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('meja')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('meja.update', $meja->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="cabang_id" class="form-label">{{ str_replace('_', ' ', ucwords('cabang')) }}</label>
                    <select name="cabang_id" id="cabang_id" class="form-control @error('cabang_id') is-invalid @enderror">
                        <option value="" selected>-- pilih cabang --</option>
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ $meja->cabang_id == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('cabang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="konsol_id" class="form-label">{{ str_replace('_', ' ', ucwords('konsol')) }}</label>
                    <select name="konsol_id" id="konsol_id" class="form-control @error('konsol_id') is-invalid @enderror">
                        <option value="" selected>-- pilih konsol --</option>
                        @foreach($konsols as $konsol)
                            <option value="{{ $konsol->id }}" {{ $meja->konsol_id == $konsol->id ? 'selected' : '' }}>
                                {{ $konsol->id }} | {{ $konsol->jenis_konsol->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('konsol_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">{{ str_replace('_', ' ', ucwords('nama')) }}</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $meja->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">{{ str_replace('_', ' ', ucwords('status')) }}</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        @php
                            $statusOptions = ['tersedia', 'unit keluar', 'perbaikan', 'tutup'];
                        @endphp
                        <option value="" selected>-- pilih status --</option>
                        @foreach($statusOptions as $option)
                            <option value="{{ $option }}" {{ old('status', $meja->status) == $option ? 'selected' : '' }}>
                                {{ ucwords($option) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('meja.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
