
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $isAdmin = auth()->user()->role === 'admin';
@endphp

<style>
    .dashboard-heading {
        margin-bottom: 28px;
    }

    .dashboard-heading h4 {
        font-weight: 700;
        color: #263b31;
        margin-bottom: 6px;
    }

    .dashboard-heading p {
        color: #89958d;
        font-size: 14px;
        margin: 0;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        padding: 22px;
        height: 100%;
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(35,75,60,.07);
    }

    .stat-label {
        color: #89958d;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: 700;
        color: #263b31;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .icon-green {
        background: #e7f0e9;
        color: #32674d;
    }

    .icon-blue {
        background: #e8eff7;
        color: #52799e;
    }

    .icon-orange {
        background: #fff1df;
        color: #c18436;
    }

    .section-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .section-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0ec;
    }

    .section-header h6 {
        font-weight: 700;
        color: #263b31;
        margin: 0;
    }

    .custom-table {
        margin: 0;
    }

    .custom-table thead th {
        background: #f8faf7;
        color: #89958d;
        font-size: 12px;
        font-weight: 600;
        padding: 14px 20px;
        border: none;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .custom-table tbody td {
        padding: 16px 20px;
        font-size: 13px;
        color: #526057;
        vertical-align: middle;
        border-color: #f0f2ef;
    }

    .product-code {
        font-weight: 600;
        color: #32674d;
    }

    .stock-warning {
        background: #fff1df;
        color: #b8792e;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    .empty-state {
        padding: 35px;
        text-align: center;
        color: #89958d;
        font-size: 13px;
    }
</style>

<div class="dashboard-heading">
    <h4>Dashboard</h4>
    <p>Ringkasan informasi dan kondisi inventory StockFlow.</p>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="stat-label mb-0">Total Produk</div>
                <div class="stat-icon icon-green">▦</div>
            </div>
            <div class="stat-number">{{ $stats['products'] }}</div>
            <div class="small text-muted mt-2">Produk terdaftar</div>
        </div>
    </div>

    @if($isAdmin)
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="stat-label mb-0">Total Supplier</div>
                <div class="stat-icon icon-blue">♙</div>
            </div>
            <div class="stat-number">{{ $stats['suppliers'] }}</div>
            <div class="small text-muted mt-2">Supplier terdaftar</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="stat-label mb-0">Purchase Order</div>
                <div class="stat-icon icon-green">▤</div>
            </div>
            <div class="stat-number">{{ $stats['purchase_orders'] }}</div>
            <div class="small text-muted mt-2">Total purchase order</div>
        </div>
    </div>
    @endif

    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="stat-label mb-0">Stok Menipis</div>
                <div class="stat-icon icon-orange">!</div>
            </div>
            <div class="stat-number">{{ $stats['low_stock'] }}</div>
            <div class="small text-muted mt-2">Produk perlu diperhatikan</div>
        </div>
    </div>

</div>

<div class="section-card">

    <div class="section-header d-flex justify-content-between align-items-center">
        <div>
            <h6>Produk Stok Menipis</h6>
            <small class="text-muted">Daftar produk yang mencapai batas minimum stok.</small>
        </div>

        <span class="stock-warning">
            {{ $stats['low_stock'] }} Produk
        </span>
    </div>

    <div class="table-responsive">
        <table class="table custom-table">
            <thead>
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th class="text-end">Stok Saat Ini</th>
                    <th class="text-end">Minimum Stok</th>
                </tr>
            </thead>

            <tbody>
                @forelse($lowStock as $p)
                    <tr>
                        <td>
                            <span class="product-code">
                                {{ $p->product_code }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $p->product_name }}
                        </td>

                        <td>
                            {{ $p->category->category_name }}
                        </td>

                        <td class="text-end">
                            <span class="stock-warning">
                                {{ $p->current_stock + 0 }} {{ $p->unit }}
                            </span>
                        </td>

                        <td class="text-end">
                            {{ $p->minimum_stock + 0 }} {{ $p->unit }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                Semua stok dalam kondisi aman.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
