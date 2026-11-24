
@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<style>
    .page-header {
        margin-bottom: 25px;
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

    .breadcrumb-text {
        font-size: 12px;
        color: #89958d;
        margin-bottom: 10px;
    }

    .breadcrumb-text a {
        color: #32674d;
        text-decoration: none;
    }

    .form-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        max-width: 720px;
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

    .form-card-body .form-control,
    .form-card-body .form-select {
        border: 1px solid #e1e8e1;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
    }

    .form-card-body .form-control:focus,
    .form-card-body .form-select:focus {
        border-color: #8ca997;
        box-shadow: 0 0 0 3px rgba(35, 75, 60, .08);
    }

    .form-card-body .form-text {
        font-size: 11px;
        color: #89958d;
        margin-top: 6px;
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

<div class="page-header">

    <div class="breadcrumb-text">
        <a href="{{ route('products.index') }}">Products</a>
        / Edit Produk
    </div>

    <h4>Edit Produk</h4>
    <p>Perbarui informasi produk yang sudah terdaftar di inventory.</p>

</div>

<form
    method="POST"
    action="{{ route('products.update', $product) }}"
    class="form-card"
>

    @csrf
    @method('PUT')

    <div class="form-card-header">
        <h6>Informasi Produk</h6>
        <p>Ubah detail produk sesuai informasi terbaru.</p>
    </div>

    <div class="form-card-body">

        @include('products._form')

    </div>

    <div class="form-card-footer">

        <a href="{{ route('products.index') }}" class="btn-cancel">
            Batal
        </a>

        <button type="submit" class="btn-save">
            Perbarui Produk
        </button>

    </div>

</form>

@endsection
