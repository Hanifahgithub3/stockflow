
@extends('layouts.app')

@section('title', 'Buat Purchase Order')

@section('content')
@php
    $productOptions = $products->map(fn ($p) => [
        'id' => $p->id,
        'label' => $p->product_code . ' - ' . $p->product_name . ' (' . $p->unit . ')',
    ])->values();

    $oldItems = old('items', [['product_id' => '', 'quantity' => '', 'unit_price' => '']]);
@endphp

<style>
    .po-page {
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
        font-size: 14px;
        margin-bottom: 24px;
    }

    .po-card {
        background: #FFFFFF;
        border: 1px solid #E6EBE6;
        border-radius: 14px;
        padding: 26px;
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
        margin-bottom: 22px;
    }

    .po-card .form-label {
        color: #344B40;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .po-card .form-control,
    .po-card .form-select {
        border: 1px solid #DCE4DD;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
    }

    .po-card .form-control:focus,
    .po-card .form-select:focus {
        border-color: #527565;
        box-shadow: 0 0 0 3px rgba(82, 117, 101, 0.12);
    }

    .po-table-wrapper {
        overflow-x: auto;
        border: 1px solid #E6EBE6;
        border-radius: 10px;
    }

    .po-table {
        min-width: 760px;
        margin-bottom: 0;
    }

    .po-table thead th {
        background: #F3F6F2;
        color: #52645A;
        font-size: 12px;
        font-weight: 700;
        padding: 13px 12px;
        border-bottom: 1px solid #E6EBE6;
        white-space: nowrap;
    }

    .po-table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-color: #EDF0EC;
    }

    .po-table tfoot th {
        background: #F8FAF7;
        color: #344B40;
        padding: 15px 12px;
        border-top: 1px solid #E6EBE6;
        font-size: 13px;
    }

    .po-table .form-control,
    .po-table .form-select {
        min-width: 90px;
    }

    .po-table td:first-child .form-select {
        min-width: 240px;
    }

    .subtotal {
        color: #344B40;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .total-value {
        color: #234B3C !important;
        font-size: 16px !important;
        font-weight: 700 !important;
    }

    .btn-add-product {
        background: #EDF3EE;
        color: #234B3C;
        border: 1px solid #D8E5DA;
        border-radius: 8px;
        padding: 9px 14px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-add-product:hover {
        background: #DDEADF;
        color: #19382D;
    }

    .po-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 8px;
    }

    .btn-po-cancel {
        background: #F1F4F0;
        color: #52645A;
        border: 1px solid #E1E7E0;
        border-radius: 8px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-po-cancel:hover {
        background: #E7ECE6;
        color: #344B40;
    }

    .btn-po-submit {
        background: #234B3C;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-po-submit:hover {
        background: #19382D;
        color: #FFFFFF;
    }

    .btn-remove {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 7px;
        font-size: 17px;
        line-height: 1;
    }

    .po-alert {
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    @media (max-width: 576px) {
        .po-card {
            padding: 18px;
        }

        .po-footer {
            flex-direction: column-reverse;
        }

        .po-footer .btn,
        .po-footer a {
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="po-page">

    <div class="po-breadcrumb">
        <a href="{{ route('purchase-orders.index') }}">Purchase Orders</a>
        <span class="mx-1">/</span>
        <span>Buat PO</span>
    </div>

    <h4 class="po-heading">Buat Purchase Order</h4>
    <p class="po-subtitle">
        Buat pesanan pembelian baru dan tentukan produk yang akan dipesan.
    </p>

    @if($errors->any())
        <div class="alert alert-danger po-alert">
            <strong class="d-block mb-2">Terdapat kesalahan pada input:</strong>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('purchase-orders.store') }}">
        @csrf

        <div class="po-card">
            <h6 class="section-heading">Informasi Purchase Order</h6>
            <p class="section-description">
                Lengkapi informasi supplier dan detail pesanan.
            </p>

            <div class="row">
                <div class="col-md-5 mb-3">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="">-- Pilih supplier --</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>
                                {{ $s->supplier_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Order</label>
                    <input
                        type="date"
                        name="order_date"
                        value="{{ old('order_date', now()->format('Y-m-d')) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" @selected(old('status') === 'draft')>
                            Draft
                        </option>
                        <option value="submitted" @selected(old('status', 'submitted') === 'submitted')>
                            Submitted
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="po-card">
            <h6 class="section-heading">Item Pesanan</h6>
            <p class="section-description">
                Pilih produk, masukkan jumlah dan harga satuan.
            </p>

            <div class="po-table-wrapper">
                <table class="table po-table align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th width="120">Qty</th>
                            <th width="160">Harga Satuan</th>
                            <th width="150" class="text-end">Subtotal</th>
                            <th width="65" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="items"></tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Pesanan</th>
                            <th class="text-end total-value" id="grandTotal">0</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-3">
                <button type="button" id="addRow" class="btn-add-product">
                    + Tambah Produk
                </button>
            </div>
        </div>

        <div class="po-footer">
            <a href="{{ route('purchase-orders.index') }}" class="btn-po-cancel">
                Batal
            </a>

            <button type="submit" class="btn-po-submit">
                Simpan Purchase Order
            </button>
        </div>
    </form>
</div>

<script>
const products = @json($productOptions);
const oldItems = Object.values(@json($oldItems));
const tbody = document.getElementById('items');
const fmt = n => new Intl.NumberFormat('id-ID').format(n);
let idx = 0;

function rowHtml(i, item) {
    const opts = products.map(p =>
        `<option value="${p.id}" ${String(p.id) === String(item.product_id) ? 'selected' : ''}>${p.label}</option>`
    ).join('');

    return `<tr>
        <td>
            <select name="items[${i}][product_id]" class="form-select" required>
                <option value="">-- Pilih produk --</option>
                ${opts}
            </select>
        </td>
        <td>
            <input type="number" step="0.01" min="0.01"
                name="items[${i}][quantity]"
                value="${item.quantity ?? ''}"
                class="form-control qty" required>
        </td>
        <td>
            <input type="number" step="0.01" min="0"
                name="items[${i}][unit_price]"
                value="${item.unit_price ?? ''}"
                class="form-control price" required>
        </td>
        <td class="text-end subtotal">0</td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove remove">&times;</button>
        </td>
    </tr>`;
}

function addRow(item = {}) {
    tbody.insertAdjacentHTML('beforeend', rowHtml(idx++, item));
}

function recalc() {
    let total = 0;

    tbody.querySelectorAll('tr').forEach(tr => {
        const q = parseFloat(tr.querySelector('.qty').value) || 0;
        const p = parseFloat(tr.querySelector('.price').value) || 0;
        const sub = q * p;

        tr.querySelector('.subtotal').textContent = fmt(sub);
        total += sub;
    });

    document.getElementById('grandTotal').textContent = fmt(total);
}

tbody.addEventListener('input', recalc);

tbody.addEventListener('click', e => {
    if (e.target.classList.contains('remove') && tbody.querySelectorAll('tr').length > 1) {
        e.target.closest('tr').remove();
        recalc();
    }
});

document.getElementById('addRow').addEventListener('click', () => addRow());

oldItems.forEach(item => addRow(item));
recalc();
</script>
@endsection
