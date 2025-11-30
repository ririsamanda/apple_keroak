@extends('layouts.admin')

@section('title', 'Laporan Transaksi')

@section('content')
<h3 class="mb-4">Laporan Aktivitas Produksi & Distribusi</h3>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm border-0 mb-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i> Riwayat Produksi</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>PIC (Karyawan)</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th> </tr>
            </thead>
            <tbody>
                @forelse($riwayatProduksi as $p)
                <tr>
                    <td>{{ $p->Tanggal_produksi }}</td>
                    <td>{{ $p->produk->Nama_produk }}</td>
                    <td>{{ $p->Jumlah_selesai }} {{ $p->produk->Satuan }}</td>
                    <td>{{ $p->karyawan->Nama_karyawan }}</td>
                    <td>{{ $p->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <form action="{{ route('laporan.destroyProduksi', $p->Id_produksi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data produksi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Belum ada data produksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="bi bi-truck me-2"></i> Riwayat Pengiriman</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>PIC Pengirim</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th> </tr>
            </thead>
            <tbody>
                @forelse($riwayatPengiriman as $kirim)
                <tr>
                    <td>{{ $kirim->Tanggal_kirim }}</td>
                    <td>{{ $kirim->pelanggan->Nama_pelanggan }}</td>
                    <td>{{ $kirim->pelanggan->Alamat }}</td>
                    <td>{{ $kirim->karyawan->Nama_karyawan }}</td>
                    <td><span class="badge bg-info text-dark">{{ $kirim->Status_pengiriman }}</span></td>
                    <td class="text-center">
                        <form action="{{ route('laporan.destroyPengiriman', $kirim->Id_pengiriman) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pengiriman ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Belum ada data pengiriman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection