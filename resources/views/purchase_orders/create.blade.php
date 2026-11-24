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

<h4>Buat Purchase Order</h4>

@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul></div>
@endif

<form method="POST" action="{{ route('purchase-orders.store') }}" class="card card-body">
    @csrf
    <div class="row">
        <div class="col-md-5 mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select" required>
                <option value="">-- Pilih supplier --</option>
                @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" @selected(old('supplier_id') == $s->id)>{{ $s->supplier_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label">Tanggal Order</label>
            <input type="date" name="order_date" value="{{ old('order_date', now()->format('Y-m-d')) }}" class="form-control" required>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                <option value="submitted" @selected(old('status', 'submitted') === 'submitted')>Submitted</option>
            </select>
        </div>
    </div>

    <h6>Item</h6>
    <table class="table table-bordered align-middle">
        <thead><tr><th>Produk</th><th width="140">Qty</th><th width="180">Harga Satuan</th><th width="160" class="text-end">Subtotal</th><th width="50"></th></tr></thead>
        <tbody id="items"></tbody>
        <tfoot><tr><th colspan="3" class="text-end">Total</th><th class="text-end" id="grandTotal">0</th><th></th></tr></tfoot>
    </table>
    <div class="mb-3">
        <button type="button" id="addRow" class="btn btn-outline-secondary btn-sm">+ Tambah Produk</button>
    </div>

    <div>
        <button class="btn btn-primary">Simpan PO</button>
        <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>

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
        <td><select name="items[${i}][product_id]" class="form-select" required>
            <option value="">-- Pilih produk --</option>${opts}</select></td>
        <td><input type="number" step="0.01" min="0.01" name="items[${i}][quantity]" value="${item.quantity ?? ''}" class="form-control qty" required></td>
        <td><input type="number" step="0.01" min="0" name="items[${i}][unit_price]" value="${item.unit_price ?? ''}" class="form-control price" required></td>
        <td class="text-end subtotal">0</td>
        <td><button type="button" class="btn btn-sm btn-outline-danger remove">&times;</button></td>
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