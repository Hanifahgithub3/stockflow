
@extends('layouts.app')

@section('title', 'Detail Produk')

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

    .detail-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        max-width: 720px;
        overflow: hidden;
    }

    .detail-card-header {
        padding: 22px 24px;
        border-bottom: 1px solid #edf0ec;
    }

    .product-code {
        display: inline-block;
        background: #e7f0e9;
        color: #32674d;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .detail-card-header h5 {
        color: #263b31;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .detail-card-header p {
        font-size: 12px;
        color: #89958d;
        margin: 0;
    }

    .detail-card-body {
        padding: 10px 24px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 17px 0;
        border-bottom: 1px solid #f0f2ef;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-size: 13px;
        color: #89958d;
    }

    .detail-value {
        font-size: 13px;
        font-weight: 600;
        color: #263b31;
        text-align: right;
    }

    .stock-value {
        font-size: 16px;
        font-weight: 700;
        color: #263b31;
    }

    .stock-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-safe {
        background: #e5f4e9;
        color: #287346;
    }

    .status-low {
        background: #fff2df;
        color: #ad792e;
    }

    .status-critical {
        background: #fce8e7;
        color: #b94c45;
    }

    .detail-card-footer {
        padding: 17px 24px;
        background: #fafbf9;
        border-top: 1px solid #edf0ec;
    }

    .btn-back {
        background: white;
        color: #647168;
        border: 1px solid #e1e8e1;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #f1f4f0;
        color: #263b31;
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header">

    <div class="breadcrumb-text">
        <a href="{{ route('products.index') }}">Products</a>
        / Detail Produk
    </div>

    <h4>Detail Produk</h4>
    <p>Informasi lengkap produk yang terdaftar di inventory.</p>

</div>

<!-- PRODUCT DETAIL -->
<div class="detail-card">

    <div class="detail-card-header">

        <span class="product-code">
            SKU: {{ $product->product_code }}
        </span>

        <h5>{{ $product->product_name }}</h5>

        <p>Informasi produk dan kondisi stok saat ini.</p>

    </div>

    <div class="detail-card-body">

        <div class="detail-row">
            <span class="detail-label">Kategori</span>
            <span class="detail-value">
                {{ $product->category->category_name }}
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Satuan</span>
            <span class="detail-value">
                {{ $product->unit }}
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Stok Saat Ini</span>
            <span class="stock-value">
                {{ $product->current_stock + 0 }} {{ $product->unit }}
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Stok Minimum</span>
            <span class="detail-value">
                {{ $product->minimum_stock + 0 }} {{ $product->unit }}
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Status Stok</span>

            <span>
                @if($product->stock_status === 'Aman')
                    <span class="stock-status status-safe">Aman</span>
                @elseif($product->stock_status === 'Menipis')
                    <span class="stock-status status-low">Menipis</span>
                @else
                    <span class="stock-status status-critical">
                        {{ $product->stock_status }}
                    </span>
                @endif
            </span>
        </div>

    </div>

    <div class="detail-card-footer">

        <a href="{{ route('products.index') }}" class="btn-back">
            ← Kembali ke Products
        </a>

    </div>

</div>

@endsection
