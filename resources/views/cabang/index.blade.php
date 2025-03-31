@extends('template.master')

@section('master-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('cabang')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            <a href="{{ route('cabang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('kontak')) }}</th>
                            {{-- <th>{{ str_replace('_', ' ', ucwords('alamat')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('whatsapp')) }}</th> --}}
                            <th>{{ str_replace('_', ' ', ucwords('akun')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('aksi')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabangs as $cabang)
                        <tr>
                            <td>{{ $cabang->id }}</td>
                            <td>
                                <li>Nama : {{ $cabang->nama }}</li>
                                <li>Alamat : {{ $cabang->alamat }}</li>
                                <li>Whatsapp : <a href="https://wa.me/{{ $cabang->whatsapp }}" target="_blank">{{ $cabang->whatsapp }}</a></li>

                            </td>
                            <td>
                                <li>Persediaan : {{ $cabang->akun_persediaan_id ?? '-' }}) {{ $cabang->akun_persediaan->nama ?? '-' }}</li>
                                <li>Pendapatan Konsumsi : {{ $cabang->akun_pendapatan_konsumsi_id ?? '-' }}) {{ $cabang->akun_pendapatan_konsumsi->nama ?? '-' }}</li>
                                <li>Hutang Konsumsi : {{ $cabang->akun_hutang_konsumsi_id ?? '-' }}) {{ $cabang->akun_hutang_konsumsi->nama ?? '-' }}</li>
                                <li>Piutang Konsumsi : {{ $cabang->akun_piutang_konsumsi_id ?? '-' }}) {{ $cabang->akun_piutang_konsumsi->nama ?? '-' }}</li>
                                <li>HPP Konsumsi : {{ $cabang->akun_hpp_konsumsi_id ?? '-' }}) {{ $cabang->akun_hpp_konsumsi->nama ?? '-' }}</li>
                                <li>Pendapatan Rental : {{ $cabang->akun_pendapatan_rental_id ?? '-' }}) {{ $cabang->akun_pendapatan_rental->nama ?? '-' }}</li>
                                <li>Hutang Rental : {{ $cabang->akun_hutang_rental_id ?? '-' }}) {{ $cabang->akun_hutang_rental->nama ?? '-' }}</li>
                                <li>Piutang Rental : {{ $cabang->akun_piutang_rental_id ?? '-' }}) {{ $cabang->akun_piutang_rental->nama ?? '-' }}</li>
                            </td>
                            <td>
                                <a href="{{ route('cabang.edit', $cabang->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('cabang.destroy', $cabang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus cabang ini?');">
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
