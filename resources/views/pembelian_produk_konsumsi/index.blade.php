@extends('template.master')

@section('transaksi-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('pembelian_produk_konsumsi')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('pembelian_produk_konsumsi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('supplier')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('cabang')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('produk_konsumsi')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('qty')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('tagihan')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('dibayar')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('sisa')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian_produk_konsumsis as $pembelian_produk_konsumsi)
                        <tr>
                            <td>{{ $pembelian_produk_konsumsi->id }}</td>
                            <td>{{ $pembelian_produk_konsumsi->supplier->nama }}</td>
                            <td>{{ $pembelian_produk_konsumsi->cabang->nama }}</td>
                            <td>{{ $pembelian_produk_konsumsi->produk_konsumsi->nama ?? '-' }}</td>
                            <td>{{ $pembelian_produk_konsumsi->qty }}</td>
                            <td>{{ number_format($pembelian_produk_konsumsi->tagihan) }}</td>
                            <td>{{ number_format($pembelian_produk_konsumsi->dibayar) }}</td>
                            <td>{{ number_format($pembelian_produk_konsumsi->sisa) }}</td>
                            <td>
                                <a href="{{ route('pembelian_produk_konsumsi.edit', $pembelian_produk_konsumsi->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('pembelian_produk_konsumsi.destroy', $pembelian_produk_konsumsi->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('.delete-form').submit();
                }
            });
        });
    });
});
</script>
@endsection
