@extends('layouts.karyawan')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold text-primary">Input Hasil Produksi</h5>
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produksi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="Tanggal_produksi" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <select name="Id_produk" class="form-select" required>
                    <option value="">-- Pilih Produk yang Diproduksi --</option>
                    @foreach($produk as $p)
                        <option value="{{ $p->Id_produk }}">
                            {{ $p->Nama_produk }} ({{ $p->Satuan }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Selesai</label>
                <input type="number" name="Jumlah_selesai" class="form-control" placeholder="0" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan (Opsional)</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan..."></textarea>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Simpan Data Produksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection