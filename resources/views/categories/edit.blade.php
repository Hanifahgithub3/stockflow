
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<style>
    .form-page {
        max-width: 720px;
        margin: 0 auto;
    }

    .form-breadcrumb {
        font-size: 13px;
        color: #84918A;
        margin-bottom: 8px;
    }

    .form-breadcrumb a {
        color: #527565;
        text-decoration: none;
    }

    .form-heading {
        color: #234B3C;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .form-subtitle {
        color: #84918A;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .form-card {
        background: #FFFFFF;
        border: 1px solid #E6EBE6;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 3px 12px rgba(25, 56, 45, 0.04);
    }

    .form-card .form-label {
        color: #344B40;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-card .form-control {
        border: 1px solid #DCE4DD;
        border-radius: 8px;
        padding: 11px 13px;
        font-size: 14px;
    }

    .form-card .form-control:focus {
        border-color: #527565;
        box-shadow: 0 0 0 3px rgba(82, 117, 101, 0.12);
    }

    .form-help {
        color: #84918A;
        font-size: 12px;
        margin-top: 7px;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #EDF0EC;
        margin-top: 28px;
        padding-top: 20px;
    }

    .btn-form-cancel {
        background: #F1F4F0;
        color: #52645A;
        border: 1px solid #E1E7E0;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-form-cancel:hover {
        background: #E7ECE6;
        color: #344B40;
    }

    .btn-form-submit {
        background: #234B3C;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-form-submit:hover {
        background: #19382D;
        color: #FFFFFF;
    }

    @media (max-width: 576px) {
        .form-card {
            padding: 20px;
        }

        .form-footer {
            flex-direction: column-reverse;
        }

        .form-footer .btn,
        .form-footer a {
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="form-page">
    <div class="form-breadcrumb">
        <a href="{{ route('categories.index') }}">Categories</a>
        <span class="mx-1">/</span>
        <span>Edit</span>
    </div>

    <h4 class="form-heading">Edit Kategori</h4>
    <p class="form-subtitle">
        Perbarui informasi kategori produk yang sudah terdaftar.
    </p>

    <form method="POST" action="{{ route('categories.update', $category) }}"
          class="form-card">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>

            <input
                type="text"
                name="category_name"
                value="{{ old('category_name', $category->category_name) }}"
                class="form-control @error('category_name') is-invalid @enderror"
                placeholder="Contoh: Minuman, Makanan, Bahan Baku"
            >

            @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-help">
                Gunakan nama yang jelas agar kategori mudah dikenali.
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('categories.index') }}" class="btn-form-cancel">
                Batal
            </a>

            <button type="submit" class="btn-form-submit">
                Perbarui Kategori
            </button>
        </div>
    </form>
</div>
@endsection
