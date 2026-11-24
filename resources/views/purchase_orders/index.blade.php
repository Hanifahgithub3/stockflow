@extends('layouts.app')
@section('title', 'Purchase Orders')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Purchase Orders</h4>
    <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary">Buat PO</a>
</div>
<form method="GET" class="mb-3 d-flex gap-2" style="max-width:350px">
    <select name="status" class="form-select">
        <option value="">Semua status</option>
        @foreach(['draft', 'submitted', 'partially_received', 'completed', 'cancelled'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucwords(str_replace('_', ' ', $s)) }}</option>
        @endforeach
    </select>
    <button class="btn btn-outline-secondary">Filter</button>
</form>
<table class="table table-bordered bg-white">
    <thead><tr><th>No. PO</th><th>Supplier</th><th>Tanggal</th><th>Status</th><th class="text-end">Total</th><th width="90">Aksi</th></tr></thead>
    <tbody>
    @forelse($orders as $o)
        <tr>
            <td>{{ $o->po_number }}</td>
            <td>{{ $o->supplier->supplier_name }}</td>
            <td>{{ \Carbon\Carbon::parse($o->order_date)->format('d/m/Y') }}</td>
            <td>@include('purchase_orders._status', ['status' => $o->status])</td>
            <td class="text-end">Rp{{ number_format($o->total_amount, 0, ',', '.') }}</td>
            <td><a href="{{ route('purchase-orders.show', $o) }}" class="btn btn-sm btn-info">Detail</a></td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted">Belum ada Purchase Order.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $orders->links('pagination::bootstrap-5') }}
@endsection