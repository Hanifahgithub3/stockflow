
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<style>
    .page-header {
        margin-bottom: 25px;
    }

    .breadcrumb-text {
        font-size: 12px;
        color: #89958d;
        margin-bottom: 10px;
    }

    .breadcrumb-text a {
        color: #32674d;
        text-decoration: none;
    }

    .page-header h4 {
        font-weight: 700;
        color: #263b31;
        margin-bottom: 6px;
    }

    .page-header p {
        font-size: 13px;
        color: #89958d;
        margin: 0;
    }

    .form-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        max-width: 600px;
        overflow: hidden;
    }

    .form-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #edf0ec;
    }

    .form-card-header h6 {
        color: #263b31;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .form-card-header p {
        font-size: 12px;
        color: #89958d;
        margin: 0;
    }

    .form-card-body {
        padding: 24px;
    }

    .form-card-body label {
        color: #526057;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-card-body .form-control {
        border: 1px solid #e1e8e1;
        border-radius: 8px;
        padding: 11px 12px;
        font-size: 13px;
    }

    .form-card-body .form-control:focus {
        border-color: #8ca997;
        box-shadow: 0 0 0 3px rgba(35, 75, 60, .08);
    }

    .form-card-footer {
        padding: 17px 24px;
        background: #fafbf9;
        border-top: 1px solid #edf0ec;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-save {
        background: #234b3c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #19382d;
        color: white;
    }

    .btn-cancel {
        background: white;
        color: #647168;
        border: 1px solid #e1e8e1;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #f1f4f0;
        color: #263b31;
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header">

    <div class="breadcrumb-text">
        <a href="{{ route('categories.index') }}">Categories</a>
        / Tambah Kategori
    </div>

    <h4>Tambah Kategori</h4>
    <p>Tambahkan kategori baru untuk mengelompokkan produk inventory.</p>

</div>

<!-- FORM -->
<form method="POST" action="{{ route('categories.store') }}" class="form-card">

    @csrf

    <div class="form-card-header">
        <h6>Informasi Kategori</h6>
        <p>Masukkan nama kategori yang ingin ditambahkan.</p>
    </div>

    <div class="form-card-body">

        <div class="mb-3">

            <label class="form-label">Nama Kategori</label>

            <input
                type="text"
                name="category_name"
                placeholder="Contoh: Bahan Baku"
                value="{{ old('category_name') }}"
                class="form-control @error('category_name') is-invalid @enderror"
            >

            @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

    </div>

    <div class="form-card-footer">

        <a href="{{ route('categories.index') }}" class="btn-cancel">
            Batal
        </a>

        <button type="submit" class="btn-save">
            Simpan Kategori
        </button>

    </div>

</form>

@endsection
