
@extends('layouts.app')

@section('title', $order->po_number)

@section('content')
<style>
    .po-detail-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .po-breadcrumb {
        font-size: 13px;
        color: #84918A;
        margin-bottom: 8px;
    }

    .po-breadcrumb a {
        color: #527565;
        text-decoration: none;
    }

    .po-heading {
        color: #234B3C;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .po-subtitle {
        color: #84918A;
        font-size: 13px;
        margin-bottom: 24px;
    }

    .po-detail-card {
        background: #FFFFFF;
        border: 1px solid #E6EBE6;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 3px 12px rgba(25, 56, 45, 0.04);
    }

    .section-heading {
        color: #234B3C;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .section-description {
        color: #84918A;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .info-item {
        border-bottom: 1px solid #EDF0EC;
        padding-bottom: 13px;
    }

    .info-label {
        display: block;
        color: #84918A;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .info-value {
        color: #344B40;
        font-size: 14px;
        font-weight: 600;
    }

    .total-card {
        background: #F1F5F0;
        border: 1px solid #DFE9DF;
        border-radius: 12px;
        padding: 20px;
        margin-top: 22px;
    }

    .total-label {
        color: #718078;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .total-amount {
        color: #234B3C;
        font-size: 24px;
        font-weight: 700;
    }

    .po-table-wrapper {
        overflow-x: auto;
        border: 1px solid #E6EBE6;
        border-radius: 10px;
    }

    .po-table {
        min-width: 650px;
        margin-bottom: 0;
    }

    .po-table thead th {
        background: #F3F6F2;
        color: #52645A;
        font-size: 12px;
        font-weight: 700;
        padding: 14px 12px;
        border-bottom: 1px solid #E6EBE6;
        white-space: nowrap;
    }

    .po-table tbody td {
        color: #46584D;
        font-size: 13px;
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #EDF0EC;
    }

    .product-code {
        color: #84918A;
        font-size: 11px;
        margin-top: 4px;
    }

    .po-table tfoot th {
        background: #F8FAF7;
        color: #344B40;
        padding: 15px 12px;
        font-size: 13px;
        border-top: 1px solid #E6EBE6;
    }

    .po-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        padding-bottom: 10px;
    }

    .btn-po-primary {
        background: #234B3C;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-po-primary:hover {
        background: #19382D;
        color: #FFFFFF;
    }

    .btn-po-danger {
        background: #FFFFFF;
        color: #B54747;
        border: 1px solid #E7CACA;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-po-danger:hover {
        background: #FFF3F3;
        color: #963838;
    }

    .btn-po-back {
        background: #F1F4F0;
        color: #52645A;
        border: 1px solid #E1E7E0;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-po-back:hover {
        background: #E7ECE6;
        color: #344B40;
    }

    @media (max-width: 576px) {
        .po-detail-card {
            padding: 18px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .total-amount {
            font-size: 21px;
        }

        .po-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .po-actions form,
        .po-actions button,
        .po-actions a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="po-detail-page">

    <div class="po-breadcrumb">
        <a href="{{ route('purchase-orders.index') }}">Purchase Orders</a>
        <span class="mx-1">/</span>
        <span>Detail</span>
    </div>

    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h4 class="po-heading">{{ $order->po_number }}</h4>
            <p class="po-subtitle mb-0">
                Detail informasi dan item purchase order.
            </p>
        </div>

        <div>
            @include('purchase_orders._status', ['status' => $order->status])
        </div>
    </div>

    <div class="po-detail-card">
        <h6 class="section-heading">Informasi Purchase Order</h6>
        <p class="section-description">
            Informasi supplier dan pencatatan pesanan pembelian.
        </p>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Nomor PO</span>
                <span class="info-value">{{ $order->po_number }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Supplier</span>
                <span class="info-value">{{ $order->supplier->supplier_name }}</span>
            </div>

            <div class="info-item">
                <span class="info-label">Tanggal Order</span>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Dibuat Oleh</span>
                <span class="info-value">{{ $order->creator->name }}</span>
            </div>
        </div>

        <div class="total-card">
            <div class="total-label">Total Purchase Order</div>
            <div class="total-amount">
                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="po-detail-card">
        <h6 class="section-heading">Item Pesanan</h6>
        <p class="section-description">
            Daftar produk yang tercantum dalam purchase order ini.
        </p>

        <div class="po-table-wrapper">
            <table class="table po-table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">
                                    {{ $item->product->product_name }}
                                </div>
                                <div class="product-code">
                                    {{ $item->product->product_code }}
                                </div>
                            </td>

                            <td class="text-end">
                                {{ $item->quantity + 0 }} {{ $item->product->unit }}
                            </td>

                            <td class="text-end">
                                Rp{{ number_format($item->unit_price, 0, ',', '.') }}
                            </td>

                            <td class="text-end fw-semibold">
                                Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th class="text-end">
                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="po-actions">

        @if($order->status === 'draft')
            <form method="POST" action="{{ route('purchase-orders.status', $order) }}">
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="submitted">

                <button type="submit" class="btn-po-primary">
                    Submit PO
                </button>
            </form>
        @endif

        @if(in_array($order->status, ['draft', 'submitted']))
            <form method="POST"
                  action="{{ route('purchase-orders.status', $order) }}"
                  onsubmit="return confirm('Batalkan PO ini?')">

                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="cancelled">

                <button type="submit" class="btn-po-danger">
                    Batalkan PO
                </button>
            </form>
        @endif

        <a href="{{ route('purchase-orders.index') }}" class="btn-po-back">
            Kembali
        </a>
    </div>

</div>
@endsection
