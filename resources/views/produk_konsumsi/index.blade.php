@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('produk_konsumsi')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('produk_konsumsi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            {{-- <th>{{ str_replace('_', ' ', ucwords('jenis_konsol')) }}</th> --}}
                            <th>{{ str_replace('_', ' ', ucwords('nama')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('harga_beli')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('harga_jual')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('poin')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk_konsumsis as $produk_konsumsi)
                        <tr>
                            <td>{{ $produk_konsumsi->id }}</td>
                            {{-- <td>{{ $produk_konsumsi->jenis_konsol->nama }}</td> --}}
                            <td>{{ $produk_konsumsi->nama }}</td>
                            <td>{{ number_format($produk_konsumsi->harga_beli) }}</td>
                            <td>{{ number_format($produk_konsumsi->harga_jual) }}</td>
                            <td>{{ $produk_konsumsi->poin }}</td>
                            <td>
                                <a href="{{ route('produk_konsumsi.edit', $produk_konsumsi->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('produk_konsumsi.destroy', $produk_konsumsi->id) }}" method="POST" class="d-inline delete-form">
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
