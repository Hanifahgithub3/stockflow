@extends('layouts.app')
@section('title', $order->po_number)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">{{ $order->po_number }}</h4>
    @include('purchase_orders._status', ['status' => $order->status])
</div>

<table class="table table-bordered bg-white" style="max-width:600px">
    <tr><th width="180">Supplier</th><td>{{ $order->supplier->supplier_name }}</td></tr>
    <tr><th>Tanggal Order</th><td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td></tr>
    <tr><th>Dibuat Oleh</th><td>{{ $order->creator->name }}</td></tr>
    <tr><th>Total</th><td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td></tr>
</table>

<h6>Item</h6>
<table class="table table-bordered bg-white">
    <thead><tr><th>Produk</th><th class="text-end">Qty</th><th class="text-end">Harga Satuan</th><th class="text-end">Subtotal</th></tr></thead>
    <tbody>
    @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->product_code }} - {{ $item->product->product_name }}</td>
            <td class="text-end">{{ $item->quantity + 0 }} {{ $item->product->unit }}</td>
            <td class="text-end">Rp{{ number_format($item->unit_price, 0, ',', '.') }}</td>
            <td class="text-end">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex gap-2">
    @if($order->status === 'draft')
        <form method="POST" action="{{ route('purchase-orders.status', $order) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="submitted">
            <button class="btn btn-primary">Submit PO</button>
        </form>
    @endif
    @if(in_array($order->status, ['draft', 'submitted']))
        <form method="POST" action="{{ route('purchase-orders.status', $order) }}" onsubmit="return confirm('Batalkan PO ini?')">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="cancelled">
            <button class="btn btn-outline-danger">Batalkan PO</button>
        </form>
    @endif
    <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection