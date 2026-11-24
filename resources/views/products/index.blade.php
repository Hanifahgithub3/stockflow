
@extends('layouts.app')

@section('title', 'Products')

@section('content')

@php
    $isAdmin = auth()->user()->role === 'admin';
@endphp

<style>
    .page-header {
        margin-bottom: 28px;
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

    .product-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .search-box {
        max-width: 360px;
        width: 100%;
    }

    .search-box .form-control {
        border: 1px solid #e4e9e4;
        border-radius: 9px 0 0 9px;
        font-size: 13px;
        padding: 11px 14px;
    }

    .search-box .btn {
        border-radius: 0 9px 9px 0;
        font-size: 13px;
        background: white;
        border-color: #e4e9e4;
        color: #526057;
    }

    .btn-add {
        background: #234b3c;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-add:hover {
        background: #19382d;
        color: white;
    }

    .product-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .product-card-header {
        padding: 19px 22px;
        border-bottom: 1px solid #edf0ec;
    }

    .product-card-header h6 {
        font-weight: 700;
        color: #263b31;
        margin: 0;
    }

    .product-table {
        margin: 0;
    }

    .product-table thead th {
        background: #f8faf7;
        color: #89958d;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
        padding: 15px 18px;
        border: none;
        white-space: nowrap;
    }

    .product-table tbody td {
        padding: 16px 18px;
        font-size: 13px;
        color: #526057;
        vertical-align: middle;
        border-color: #f0f2ef;
    }

    .product-code {
        color: #32674d;
        font-weight: 700;
        font-size: 12px;
    }

    .product-name {
        color: #263b31;
        font-weight: 600;
    }

    .stock-number {
        font-weight: 600;
        color: #263b31;
    }

    .stock-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-safe {
        background: #e7f2e9;
        color: #32724b;
    }

    .status-low {
        background: #fff2df;
        color: #b8792e;
    }

    .status-empty {
        background: #fce8e7;
        color: #b94c45;
    }

    .action-btn {
        font-size: 11px;
        padding: 6px 10px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        font-weight: 600;
    }

    .btn-detail {
        background: #e8eff7;
        color: #52799e;
    }

    .btn-edit {
        background: #fff2df;
        color: #ad792e;
    }

    .btn-delete {
        background: #fce8e7;
        color: #b94c45;
    }

    .btn-detail:hover,
    .btn-edit:hover,
    .btn-delete:hover {
        opacity: .8;
    }

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: #89958d;
        font-size: 13px;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        color: #32674d;
        border-color: #edf0ec;
        font-size: 12px;
    }

    .pagination .active .page-link {
        background: #234b3c;
        border-color: #234b3c;
        color: white;
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <h4>Products</h4>
    <p>Kelola informasi produk dan pantau ketersediaan stok inventory.</p>
</div>

<!-- TOOLBAR -->
<div class="product-toolbar">

    <form method="GET" class="input-group search-box">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            class="form-control"
            placeholder="Cari kode atau nama produk..."
        >
        <button class="btn" type="submit">
            Cari
        </button>
    </form>

    @if($isAdmin)
        <a href="{{ route('products.create') }}" class="btn-add">
            + Tambah Produk
        </a>
    @endif

</div>

<!-- PRODUCT TABLE -->
<div class="product-card">

    <div class="product-card-header d-flex justify-content-between align-items-center">
        <h6>Daftar Produk</h6>

        <span class="text-muted small">
            {{ $products->total() }} produk terdaftar
        </span>
    </div>

    <div class="table-responsive">

        <table class="table product-table">

            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Minimum</th>
                    <th>Status</th>
                    <th width="190">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $p)

                    <tr>

                        <td>
                            <span class="product-code">
                                {{ $p->product_code }}
                            </span>
                        </td>

                        <td>
                            <span class="product-name">
                                {{ $p->product_name }}
                            </span>
                        </td>

                        <td>
                            {{ $p->category->category_name }}
                        </td>

                        <td>
                            <span class="stock-number">
                                {{ $p->current_stock + 0 }}
                            </span>
                            {{ $p->unit }}
                        </td>

                        <td>
                            {{ $p->minimum_stock + 0 }}
                            {{ $p->unit }}
                        </td>

                        <td>
                            <span class="stock-status
                                {{ $p->stock_status === 'Aman'
                                    ? 'status-safe'
                                    : ($p->stock_status === 'Menipis'
                                        ? 'status-low'
                                        : 'status-empty') }}">
                                {{ $p->stock_status }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-1">

                                <a href="{{ route('products.show', $p) }}"
                                   class="action-btn btn-detail">
                                    Detail
                                </a>

                                @if($isAdmin)

                                    <a href="{{ route('products.edit', $p) }}"
                                       class="action-btn btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('products.destroy', $p) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Hapus produk ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                @endif

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                Belum ada produk yang terdaftar.
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-3 border-top d-flex justify-content-end">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
