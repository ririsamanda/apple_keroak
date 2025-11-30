@extends('layouts.karyawan')

@section('title', 'Input Pengiriman')

@section('content')
<style>
    /* --- TEMA NAVY & CLEAN (Konsisten) --- */
    
    /* 1. Card Form */
    .card-form {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        background-color: #fff;
    }

    /* 2. Inputs */
    .form-label {
        color: #1e3a56;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1e3a56;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(30, 58, 86, 0.1);
    }

    /* 3. Tabel Input Barang */
    .table-input thead th {
        background-color: #f1f5f9;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px;
    }

    .table-input tbody td {
        padding: 10px;
        vertical-align: top;
        border-bottom: 1px solid #f1f5f9;
    }

    /* 4. Buttons */
    .btn-save {
        background-color: #1e3a56;
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }
    .btn-save:hover {
        background-color: #162d45;
        box-shadow: 0 4px 15px rgba(30, 58, 86, 0.3);
        color: white;
    }

    .btn-add-row {
        background-color: transparent;
        border: 2px dashed #cbd5e1;
        color: #64748b;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-add-row:hover {
        border-color: #1e3a56;
        color: #1e3a56;
        background-color: #f8fafc;
    }

    .btn-delete-row {
        background-color: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }
    .btn-delete-row:hover {
        background-color: #ef4444;
        color: white;
    }
    .btn-delete-row:disabled {
        background-color: #f1f5f9;
        color: #cbd5e1;
        cursor: not-allowed;
    }
</style>

<div class="container-fluid p-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="color: #1e3a56;">Input Pengiriman Baru</h3>
        <p class="text-muted mb-0">Catat distribusi barang keluar ke pelanggan.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card card-form">
                <div class="card-body p-4 p-md-5">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Perhatian!</strong> Ada input yang belum lengkap.
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pengiriman.store') }}" method="POST">
                        @csrf

                        <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Pengiriman</h6>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Pengiriman</label>
                                <input type="date" name="Tanggal_kirim" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tujuan Pelanggan</label>
                                <select name="Id_pelanggan" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggan as $p)
                                        <option value="{{ $p->Id_pelanggan }}">{{ $p->Nama_pelanggan }} - {{ Str::limit($p->Alamat, 30) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #e2e8f0;">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted text-uppercase fw-bold mb-0" style="font-size: 0.75rem; letter-spacing: 1px;">Daftar Barang</h6>
                        </div>
                        
                        <div class="table-responsive mb-3 rounded-3 border border-light">
                            <table class="table table-input mb-0" id="tabelBarang">
                                <thead>
                                    <tr>
                                        <th width="55%">Nama Produk</th>
                                        <th width="30%">Jumlah</th>
                                        <th width="15%" class="text-center">Aksi</th>
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
                                        <td class="text-center">
                                            <button type="button" class="btn btn-delete-row remove-row" disabled>
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" class="btn btn-add-row w-100 mb-5" id="addRow">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Barang Lain
                        </button>

                        <div class="d-flex justify-content-end">
                            <a href="{{ url()->previous() }}" class="btn btn-light me-3 text-muted fw-bold px-4 py-2" style="border: 1px solid #ddd; border-radius: 10px;">Batal</a>
                            <button type="submit" class="btn btn-save px-5">
                                <i class="bi bi-send-fill me-2"></i> Proses Pengiriman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Saat tombol "Tambah Barang Lain" diklik
        $("#addRow").click(function() {
            var newRow = $("#tabelBarang tbody tr:first").clone();
            
            // Reset Nilai
            newRow.find("input").val(""); 
            newRow.find("select").val("");
            
            // Aktifkan tombol hapus
            newRow.find(".remove-row").prop("disabled", false);
            
            $("#tabelBarang tbody").append(newRow);
        });

        // Saat tombol "X" diklik
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection