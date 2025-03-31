@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('akun')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Tambah @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('akun.store') }}" method="POST">
                @csrf

                {{-- <div class="mb-3">
                    <label for="cabang_id" class="form-label">{{ str_replace('_', ' ', ucwords('cabang')) }}</label>
                    <select name="cabang_id" id="cabang_id" class="form-control @error('cabang_id') is-invalid @enderror">
                        <option value="" selected>-- pilih cabang --</option>
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                        @endforeach
                    </select>
                    @error('cabang_id')
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
                    <label for="saldo_normal" class="form-label">{{ str_replace('_', ' ', ucwords('saldo_normal')) }}</label>
                    <select name="saldo_normal" id="saldo_normal" class="form-control @error('saldo_normal') is-invalid @enderror">
                        @php
                            $saldo_normalOptions = ['debit', 'kredit'];
                        @endphp
                        <option value="" selected>-- pilih saldo_normal --</option>
                        @foreach($saldo_normalOptions as $option)
                            <option value="{{ $option }}" {{ old('saldo_normal', $akun->saldo_normal ?? '') == $option ? 'selected' : '' }}>
                                {{ ucwords($option) }}
                            </option>
                        @endforeach
                    </select>
                    @error('saldo_normal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">{{ str_replace('_', ' ', ucwords('keterangan')) }}</label>
                    <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required>{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('akun.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
