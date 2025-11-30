@extends('layouts.karyawan')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold text-success">Input Pengiriman Baru</h5>
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">Ada input yang belum diisi! Cek kembali.</div>
        @endif

        <form action="{{ route('pengiriman.store') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Pengiriman</label>
                    <input type="date" name="Tanggal_kirim" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tujuan Pelanggan</label>
                    <select name="Id_pelanggan" class="form-select" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->Id_pelanggan }}">{{ $p->Nama_pelanggan }} - {{ $p->Alamat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            <h6 class="mb-3">Daftar Barang yang Dikirim</h6>
            
            <table class="table table-bordered" id="tabelBarang">
                <thead class="table-light">
                    <tr>
                        <th width="60%">Nama Produk</th>
                        <th width="30%">Jumlah</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="Id_produk[]" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produk as $item)
                                    <option value="{{ $item->Id_produk }}">{{ $item->Nama_produk }} ({{ $item->Satuan }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="Jumlah_kirim[]" class="form-control" placeholder="0" min="1" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled><i class="bi bi-x"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-success btn-sm mb-4" id="addRow">
                <i class="bi bi-plus-circle"></i> Tambah Barang Lain
            </button>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Proses Pengiriman</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Saat tombol "Tambah Barang Lain" diklik
        $("#addRow").click(function() {
            // Ambil baris pertama, copy HTML-nya
            var newRow = $("#tabelBarang tbody tr:first").clone();
            
            // Kosongkan nilainya
            newRow.find("input").val(""); 
            newRow.find("select").val("");
            
            // Aktifkan tombol hapus di baris baru
            newRow.find(".remove-row").prop("disabled", false);
            
            // Masukkan ke tabel
            $("#tabelBarang tbody").append(newRow);
        });

        // Saat tombol "X" (Hapus) diklik
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection