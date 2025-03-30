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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('konsol.create') }}" class="btn btn-primary">
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
                            <th>{{ str_replace('_', ' ', ucwords('jenis_konsol')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('firmware')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('seri')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('harga')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('tanggal_kedatangan')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('status')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konsols as $konsol)
                        <tr>
                            <td>{{ $konsol->id }}</td>
                            <td>{{ $konsol->supplier->nama }}</td>
                            <td>{{ $konsol->jenis_konsol->nama }}</td>
                            <td>{{ $konsol->firmware->nama ?? '-' }}</td>
                            <td>{{ $konsol->seri }}</td>
                            <td>{{ number_format($konsol->harga) }}</td>
                            <td>{{ $konsol->tanggal_kedatangan }}</td>
                            <td>{{ $konsol->status }}</td>
                            <td>
                                <a href="{{ route('konsol.edit', $konsol->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('konsol.destroy', $konsol->id) }}" method="POST" class="d-inline delete-form">
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
