@extends('layouts.admin')

@section('title', 'Data Karyawan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Karyawan</h3>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Karyawan
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->Nama_karyawan }}</td>
                    <td>{{ $data->Username }}</td>
                    <td>{{ $data->Jabatan }}</td>
                    <td>
                        @if($data->hakAkses->Nama_hakakses == 'Admin')
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-success">Karyawan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('karyawan.edit', $data->Id_karyawan) }}" class="btn btn-sm btn-warning text-white">
                        <i class="bi bi-pencil"></i>
                    </a>
                    
                    <form action="{{ route('karyawan.destroy', $data->Id_karyawan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i></button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection