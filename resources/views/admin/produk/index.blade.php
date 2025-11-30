@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Produk</h3>
    <a href="{{ route('produk.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Harga (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->Nama_produk }}</td>
                    <td>{{ $data->Kategori }}</td>
                    <td>{{ $data->Satuan }}</td>
                    <td>Rp {{ number_format($data->Harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $data->Id_produk) }}" class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('produk.destroy', $data->Id_produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection