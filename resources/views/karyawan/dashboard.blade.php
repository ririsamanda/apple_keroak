@extends('layouts.karyawan')

@section('content')
<div class="row">
    <div class="col-md-12">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="alert alert-primary border-0 shadow-sm mb-5">
            <h4 class="alert-heading"><i class="bi bi-person-circle me-2"></i> Halo, {{ Auth::user()->Nama_karyawan }}!</h4>
            <p class="mb-0">Selamat bekerja. Di bawah ini adalah rekapitulasi data aktivitas yang baru saja Anda inputkan ke sistem.</p>
        </div>

        <h5 class="mb-3 text-secondary fw-bold"><i class="bi bi-clock-history"></i> Riwayat Input Saya (Terbaru)</h5>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white fw-bold text-primary">
                        Hasil Produksi Terakhir
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0 table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatProduksi as $rp)
                                <tr>
                                    <td>{{ $rp->Tanggal_produksi }}</td>
                                    <td>{{ $rp->produk->Nama_produk }}</td>
                                    <td>{{ $rp->Jumlah_selesai }} {{ $rp->produk->Satuan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data produksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="{{ route('produksi.create') }}" class="btn btn-sm btn-outline-primary w-100">Input Produksi Baru</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white fw-bold text-success">
                        Pengiriman Terakhir
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0 table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tujuan Pelanggan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatPengiriman as $rk)
                                <tr>
                                    <td>{{ $rk->Tanggal_kirim }}</td>
                                    <td>{{ $rk->pelanggan->Nama_pelanggan }}</td>
                                    <td><span class="badge bg-secondary">{{ $rk->Status_pengiriman }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data pengiriman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="{{ route('pengiriman.create') }}" class="btn btn-sm btn-outline-success w-100">Input Pengiriman Baru</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection