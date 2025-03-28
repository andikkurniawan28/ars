@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('user')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">{{ str_replace('_', ' ', ucwords('nama')) }}</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $user->nama) }}" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">{{ str_replace('_', ' ', ucwords('username')) }}</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password (Opsional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ str_replace('_', ' ', ucwords('password')) }} (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">{{ str_replace('_', ' ', ucwords('alamat')) }}</label>
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">{{ str_replace('_', ' ', ucwords('whatsapp')) }}</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                           value="{{ old('whatsapp', $user->whatsapp) }}" required>
                    @error('whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cabang_id" class="form-label">{{ str_replace('_', ' ', ucwords('cabang')) }}</label>
                    <select name="cabang_id" id="cabang_id" class="form-control @error('cabang_id') is-invalid @enderror">
                        <option value="" selected>-- Pilih Cabang --</option>
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ $user->cabang_id == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('cabang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="peran_id" class="form-label">{{ str_replace('_', ' ', ucwords('peran')) }}</label>
                    <select name="peran_id" id="peran_id" class="form-control @error('peran_id') is-invalid @enderror">
                        <option value="" selected>-- Pilih Peran --</option>
                        @foreach($perans as $peran)
                            <option value="{{ $peran->id }}" {{ $user->peran_id == $peran->id ? 'selected' : '' }}>
                                {{ $peran->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('peran_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Saklar Status Aktif/Nonaktif -->
                <div class="mb-3">
                    <label class="form-label">{{ str_replace('_', ' ', ucwords('status')) }}</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="status" id="status" class="form-check-input"
                               {{ $user->status == 'aktif' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            {{ $user->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('status').addEventListener('change', function () {
        this.nextElementSibling.innerText = this.checked ? 'Aktif' : 'Nonaktif';
    });
</script>

@endsection
