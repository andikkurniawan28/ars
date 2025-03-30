@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('pembelian_produk_konsumsi')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Tambah @yield('page-title')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelian_produk_konsumsi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tanggal" class="form-label">{{ str_replace('_', ' ', ucwords('tanggal')) }}</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                           value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                </div>

                <div class="mb-3">
                    <label for="produk_konsumsi_id" class="form-label">{{ str_replace('_', ' ', ucwords('produk_konsumsi')) }}</label>
                    <select name="produk_konsumsi_id" id="produk_konsumsi_id" class="form-control @error('produk_konsumsi_id') is-invalid @enderror">
                        <option value="" selected>-- pilih produk_konsumsi --</option>
                        @foreach($produk_konsumsis as $produk_konsumsi)
                            <option value="{{ $produk_konsumsi->id }}">{{ $produk_konsumsi->nama }}</option>
                        @endforeach
                    </select>
                    @error('produk_konsumsi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="akun_kas_id" class="form-label">{{ str_replace('_', ' ', ucwords('akun_kas')) }}</label>
                    <select name="akun_kas_id" id="akun_kas_id" class="form-control @error('akun_kas_id') is-invalid @enderror">
                        <option value="" selected>-- pilih akun_kas --</option>
                        @foreach($akuns as $akun_kas)
                            <option value="{{ $akun_kas->id }}">{{ $akun_kas->nama }}</option>
                        @endforeach
                    </select>
                    @error('akun_kas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="akun_persediaan_id" class="form-label">{{ str_replace('_', ' ', ucwords('akun_persediaan')) }}</label>
                    <select name="akun_persediaan_id" id="akun_persediaan_id" class="form-control @error('akun_persediaan_id') is-invalid @enderror">
                        <option value="" selected>-- pilih akun_persediaan --</option>
                        @foreach($akuns as $akun_persediaan)
                            <option value="{{ $akun_persediaan->id }}">{{ $akun_persediaan->nama }}</option>
                        @endforeach
                    </select>
                    @error('akun_persediaan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">{{ str_replace('_', ' ', ucwords('qty')) }}</label>
                    <input type="text" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror"
                           value="{{ old('qty') }}" required>
                    @error('qty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tagihan" class="form-label">{{ str_replace('_', ' ', ucwords('tagihan')) }}</label>
                    <input type="number" name="tagihan" id="tagihan" class="form-control @error('tagihan') is-invalid @enderror"
                           value="{{ old('tagihan') }}" required>
                    @error('tagihan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dibayar" class="form-label">{{ str_replace('_', ' ', ucwords('dibayar')) }}</label>
                    <input type="number" name="dibayar" id="dibayar" class="form-control @error('dibayar') is-invalid @enderror"
                           value="{{ old('dibayar') }}" required>
                    @error('dibayar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input readonly untuk Sisa -->
                <div class="mb-3">
                    <label for="sisa" class="form-label">{{ str_replace('_', ' ', ucwords('sisa')) }}</label>
                    <input type="number" name="sisa" id="sisa" class="form-control" value="0" readonly>
                </div>

                <!-- Script untuk menghitung sisa -->
                <script>
                    function hitungSisa() {
                        let tagihan = parseFloat(document.getElementById('tagihan').value) || 0;
                        let dibayar = parseFloat(document.getElementById('dibayar').value) || 0;
                        let sisa = tagihan - dibayar;
                        document.getElementById('sisa').value = sisa;
                    }
                </script>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('pembelian_produk_konsumsi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
