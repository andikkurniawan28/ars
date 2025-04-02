@extends('template.master')

@section('laporan-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('buku_besar')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            {{-- <a href="{{ route('buku_besar.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('timestamp')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('akun')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('keterangan')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('debit')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('kredit')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku_besars as $buku_besar)
                        <tr>
                            <td>{{ $buku_besar->id }}</td>
                            <td>{{ $buku_besar->created_at }}</td>
                            <td>{{ $buku_besar->akun->nama }}</td>
                            <td>{{ $buku_besar->keterangan }}</td>
                            <td>{{ number_format($buku_besar->debit) }}</td>
                            <td>{{ number_format($buku_besar->kredit) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
