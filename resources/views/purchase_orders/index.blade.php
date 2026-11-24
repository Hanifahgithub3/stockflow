
@extends('layouts.app')

@section('title', 'Purchase Orders')

@section('content')

<style>
    .page-header {
        margin-bottom: 26px;
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

    .btn-add {
        background: #234b3c;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add:hover {
        background: #19382d;
        color: white;
    }

    .filter-box {
        background: white;
        border: 1px solid #e8ede8;
        border-radius: 9px;
        padding: 9px 13px;
        font-size: 13px;
        min-width: 210px;
    }

    .filter-box:focus {
        border-color: #8ca997;
        box-shadow: 0 0 0 3px rgba(35, 75, 60, .08);
    }

    .btn-filter {
        background: #e7f0e9;
        color: #32674d;
        border: none;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-filter:hover {
        background: #d8e8dc;
    }

    .po-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .po-card-header {
        padding: 19px 22px;
        border-bottom: 1px solid #edf0ec;
    }

    .po-card-header h6 {
        color: #263b31;
        font-weight: 700;
        margin: 0;
    }

    .po-table {
        margin: 0;
    }

    .po-table thead th {
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

    .po-table tbody td {
        padding: 17px 18px;
        font-size: 13px;
        color: #647168;
        vertical-align: middle;
        border-color: #f0f2ef;
    }

    .po-number {
        color: #32674d;
        font-weight: 700;
    }

    .supplier-name {
        color: #263b31;
        font-weight: 600;
    }

    .po-date {
        color: #647168;
    }

    .po-total {
        color: #263b31;
        font-weight: 700;
        white-space: nowrap;
    }

    .btn-detail {
        background: #e7f0e9;
        color: #32674d;
        border: none;
        padding: 7px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-detail:hover {
        background: #d8e8dc;
        color: #234b3c;
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
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">

    <div>
        <h4>Purchase Orders</h4>
        <p>Kelola pesanan pembelian dan pantau status penerimaan barang.</p>
    </div>

    <a href="{{ route('purchase-orders.create') }}" class="btn-add">
        + Buat Purchase Order
    </a>

</div>

<!-- STATUS FILTER -->
<form method="GET" class="d-flex gap-2 flex-wrap mb-4">

    <select name="status" class="filter-box">
        <option value="">Semua Status</option>

        @foreach(['draft', 'submitted', 'partially_received', 'completed', 'cancelled'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>
                {{ ucwords(str_replace('_', ' ', $s)) }}
            </option>
        @endforeach

    </select>

    <button type="submit" class="btn-filter">
        Filter
    </button>

</form>

<!-- PURCHASE ORDER TABLE -->
<div class="po-card">

    <div class="po-card-header d-flex justify-content-between align-items-center">

        <h6>Daftar Purchase Order</h6>

        <span class="text-muted small">
            {{ $orders->total() }} PO terdaftar
        </span>

    </div>

    <div class="table-responsive">

        <table class="table po-table">

            <thead>
                <tr>
                    <th>No. PO</th>
                    <th>Supplier</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-end">Total</th>
                    <th width="90">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($orders as $o)

                    <tr>

                        <td>
                            <span class="po-number">
                                {{ $o->po_number }}
                            </span>
                        </td>

                        <td>
                            <span class="supplier-name">
                                {{ $o->supplier->supplier_name }}
                            </span>
                        </td>

                        <td>
                            <span class="po-date">
                                {{ \Carbon\Carbon::parse($o->order_date)->format('d/m/Y') }}
                            </span>
                        </td>

                        <td>
                            @include('purchase_orders._status', ['status' => $o->status])
                        </td>

                        <td class="text-end">
                            <span class="po-total">
                                Rp{{ number_format($o->total_amount, 0, ',', '.') }}
                            </span>
                        </td>

                        <td>
                            <a
                                href="{{ route('purchase-orders.show', $o) }}"
                                class="btn-detail"
                            >
                                Detail
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                Belum ada Purchase Order yang terdaftar.
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-3 border-top d-flex justify-content-end">
        {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
