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
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Isi @yield('page-title')</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('jurnal_umum.update', $id) }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" value="{{ $id }}" name="jurnal_umum_id">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="akun" class="form-label">{{ str_replace('_', ' ', ucwords('akun')) }}</label>
                                <select name="akun_id" class="form-control" id="akun_id">
                                    @foreach ($akuns as $akun)
                                        <option value="{{ $akun->id }}">
                                            {{ $akun->id }}) {{ $akun->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="keterangan" class="form-label">{{ str_replace('_', ' ', ucwords('keterangan')) }}</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="debit" class="form-label">{{ str_replace('_', ' ', ucwords('debit')) }}</label>
                            <input type="number" name="debit" id="debit" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="kredit" class="form-label">{{ str_replace('_', ' ', ucwords('kredit')) }}</label>
                            <input type="number" name="kredit" id="kredit" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('jurnal_umum.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> Selesai
                    </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const debitInput = document.getElementById('debit');
            const kreditInput = document.getElementById('kredit');

            debitInput.addEventListener('input', function() {
                if (debitInput.value) {
                    kreditInput.disabled = true;
                    kreditInput.value = ''; // Reset kredit if debit is filled
                } else {
                    kreditInput.disabled = false;
                }
            });

            kreditInput.addEventListener('input', function() {
                if (kreditInput.value) {
                    debitInput.disabled = true;
                    debitInput.value = ''; // Reset debit if kredit is filled
                } else {
                    debitInput.disabled = false;
                }
            });
        });
    </script>
@endsection
