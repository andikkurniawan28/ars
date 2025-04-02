@extends('template.master')

@section('transaksi-aktif')
    {{ 'active' }}
@endsection

@section('page-title')
    {{ str_replace('_', ' ', ucwords('log_aktivitas')) }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">@yield('page-title')</h4>
            {{-- <a href="{{ route('log_aktivitas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah @yield('page-title')
            </a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ str_replace('_', ' ', ucwords('ID')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('user')) }}</th>
                            <th>{{ str_replace('_', ' ', ucwords('keterangan')) }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log_aktivitass as $log_aktivitas)
                        <tr>
                            <td>{{ $log_aktivitas->id }}</td>
                            <td>{{ $log_aktivitas->user->nama }}</td>
                            <td>{{ $log_aktivitas->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
