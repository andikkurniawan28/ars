@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('stok_cabang')) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary">@yield('page-title') - {{ $produk->nama }} di {{ $cabang->nama }}</h4>
                {{-- <a href="{{ route('stok_cabang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah @yield('page-title')
                </a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                                <th>{{ str_replace('_', ' ', ucwords('timestamp')) }}</th>
                                <th>{{ str_replace('_', ' ', ucwords('keterangan')) }}</th>
                                <th>{{ str_replace('_', ' ', ucwords('masuk')) }}</th>
                                <th>{{ str_replace('_', ' ', ucwords('keluar')) }}</th>
                                <th>{{ str_replace('_', ' ', ucwords('saldo')) }}</th> <!-- Tambah kolom saldo -->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $saldo = 0; // Inisialisasi saldo awal
                            @endphp
                            @foreach ($data as $stok_cabang)
                                @php
                                    $saldo = $saldo + $stok_cabang->masuk - $stok_cabang->keluar; // Hitung saldo berulang
                                @endphp
                                <tr>
                                    <td>{{ $stok_cabang->id }}</td>
                                    <td>{{ $stok_cabang->created_at }}</td>
                                    <td>{{ $stok_cabang->keterangan }}</td>
                                    <td>{{ $stok_cabang->masuk }}</td>
                                    <td>{{ $stok_cabang->keluar }}</td>
                                    <td>{{ $saldo }}</td> <!-- Menampilkan saldo yang sudah dihitung -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
