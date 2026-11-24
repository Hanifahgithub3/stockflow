
@extends('layouts.app')

@section('title', 'Tambah Supplier')

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
        <a href="{{ route('suppliers.index') }}">Suppliers</a>
        <span class="mx-1">/</span>
        <span>Tambah</span>
    </div>

    <h4 class="form-heading">Tambah Supplier</h4>
    <p class="form-subtitle">
        Tambahkan informasi supplier baru ke dalam sistem.
    </p>

    <form method="POST" action="{{ route('suppliers.store') }}"
          class="form-card">

        @csrf

        @include('suppliers._form')

        <div class="form-footer">
            <a href="{{ route('suppliers.index') }}" class="btn-form-cancel">
                Batal
            </a>

            <button type="submit" class="btn-form-submit">
                Simpan Supplier
            </button>
        </div>
    </form>
</div>
@endsection
