@extends('template.master')

@section('transaksi-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('jurnal_umum')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('jurnal_umum.create') }}" class="btn btn-primary">
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
                            <th>{{ str_replace('_', ' ', ucwords('detail')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('admin')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal_umums as $jurnal_umum)
                        <tr>
                            <td>{{ $jurnal_umum->id }}</td>
                            <td>{{ $jurnal_umum->tanggal }}</td>
                            <td>
                                <table width="100%" class="table table-sm">
                                    <tr>
                                        <th>Akun</th>
                                        <th>Keterangan</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                    @foreach ($jurnal_umum->detail_jurnal_umum as $detail)
                                        <tr>
                                            <td>{{ $detail->akun_id }}) {{ $detail->akun->nama }}</td>
                                            <td>{{ $detail->keterangan }}</td>
                                            <td>{{ $detail->debit }}</td>
                                            <td>{{ $detail->kredit }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>{{ $jurnal_umum->user->nama }}</td>
                            <td>
                                <form action="{{ route('jurnal_umum.destroy', $jurnal_umum->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('jurnal_umum.edit', $jurnal_umum->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Isi
                                    </a>
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
