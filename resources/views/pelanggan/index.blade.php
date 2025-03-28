@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('pelanggan')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('nama')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('alamat')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('whatsapp')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('hutang')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('piutang')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('poin')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $pelanggan->id }}</td>
                            <td>{{ $pelanggan->nama }}</td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td><a href="https://wa.me/{{ $pelanggan->whatsapp }}" target="_blank">{{ $pelanggan->whatsapp }}</a></td>
                            <td>{{ $pelanggan->hutang }}</td>
                            <td>{{ $pelanggan->piutang }}</td>
                            <td>{{ $pelanggan->poin }}</td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
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
@endsection
