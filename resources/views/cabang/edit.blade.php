@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('cabang')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('cabang.update', $cabang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $cabang->nama) }}" readonly autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">{{ str_replace('_', ' ', ucwords('alamat')) }}</label>
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $cabang->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">{{ str_replace('_', ' ', ucwords('whatsapp')) }}</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                           value="{{ old('whatsapp', $cabang->whatsapp) }}" required>
                    @error('whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    $akunFields = [
                        'akun_persediaan_id' => 'Akun Persediaan',
                        'akun_pendapatan_konsumsi_id' => 'Akun Pendapatan Konsumsi',
                        'akun_hutang_konsumsi_id' => 'Akun Hutang Konsumsi',
                        'akun_piutang_konsumsi_id' => 'Akun Piutang Konsumsi',
                        'akun_hpp_konsumsi_id' => 'Akun HPP Konsumsi',
                        'akun_pendapatan_rental_id' => 'Akun Pendapatan Rental',
                        'akun_hutang_rental_id' => 'Akun Hutang Rental',
                        'akun_piutang_rental_id' => 'Akun Piutang Rental',
                    ];
                @endphp

                @foreach($akunFields as $field => $label)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                        <select name="{{ $field }}" id="{{ $field }}" class="form-control @error($field) is-invalid @enderror">
                            <option value="" selected>-- Pilih {{ strtolower($label) }} --</option>
                            @foreach($akuns as $akun)
                                <option value="{{ $akun->id }}"
                                    {{ old($field, $cabang->$field) == $akun->id ? 'selected' : '' }}>
                                    {{ $akun->id }}) {{ $akun->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error($field)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui
                    </button>
                    <a href="{{ route('cabang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
