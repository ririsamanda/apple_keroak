@extends('layouts.admin')
@section('title', 'Data Pelanggan')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Pelanggan</h3>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Pelanggan</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->Nama_pelanggan }}</td>
                    <td>{{ $data->Alamat }}</td>
                    <td>{{ $data->No_telp }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $data->Id_pelanggan) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('pelanggan.destroy', $data->Id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pelanggan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada data pelanggan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection