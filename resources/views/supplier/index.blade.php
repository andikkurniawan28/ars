@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('supplier')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary">
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
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->nama }}</td>
                            <td>{{ $supplier->alamat }}</td>
                            <td><a href="https://wa.me/{{ $supplier->whatsapp }}" target="_blank">{{ $supplier->whatsapp }}</a></td>
                            <td>{{ $supplier->hutang }}</td>
                            <td>{{ $supplier->piutang }}</td>
                            <td>
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
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
