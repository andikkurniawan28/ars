@extends('template.master')

@section('transaksi-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('penjualan_produk_rental')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('penjualan_produk_rental.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('tanggal')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('pelanggan')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('meja')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('produk')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('qty')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('mulai')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('selesai')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('tagihan')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('dibayar')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('sisa')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('admin')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan_produk_rentals as $penjualan_produk_rental)
                        <tr>
                            <td>{{ $penjualan_produk_rental->id }}</td>
                            <td>{{ $penjualan_produk_rental->tanggal }}</td>
                            <td>{{ $penjualan_produk_rental->pelanggan->nama }}</td>
                            <td>{{ $penjualan_produk_rental->meja->nama }}</td>
                            <td>{{ $penjualan_produk_rental->produk_rental->nama ?? '-' }}</td>
                            <td>{{ $penjualan_produk_rental->qty }} X {{ $penjualan_produk_rental->produk_rental->durasi }}</td>
                            <td>{{ $penjualan_produk_rental->mulai }}</td>
                            <td>{{ $penjualan_produk_rental->selesai }}</td>
                            <td>{{ number_format($penjualan_produk_rental->tagihan) }}</td>
                            <td>{{ number_format($penjualan_produk_rental->dibayar) }}</td>
                            <td>{{ number_format($penjualan_produk_rental->sisa) }}</td>
                            <td>{{ $penjualan_produk_rental->user->nama }}</td>
                            <td>
                                {{-- <a href="{{ route('penjualan_produk_rental.edit', $penjualan_produk_rental->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a> --}}
                                <form action="{{ route('penjualan_produk_rental.destroy', $penjualan_produk_rental->id) }}" method="POST" class="d-inline delete-form">
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
