@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@php $isAdmin = auth()->user()->role === 'admin'; @endphp

<h4 class="mb-3">Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-bg-primary"><div class="card-body">
            <div class="small">Total Produk</div>
            <div class="fs-2 fw-semibold">{{ $stats['products'] }}</div>
        </div></div>
    </div>
    @if($isAdmin)
    <div class="col-md-3">
        <div class="card text-bg-success"><div class="card-body">
            <div class="small">Total Supplier</div>
            <div class="fs-2 fw-semibold">{{ $stats['suppliers'] }}</div>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-info"><div class="card-body">
            <div class="small">Total Purchase Order</div>
            <div class="fs-2 fw-semibold">{{ $stats['purchase_orders'] }}</div>
        </div></div>
    </div>
    @endif
    <div class="col-md-3">
        <div class="card text-bg-warning"><div class="card-body">
            <div class="small">Stok Menipis</div>
            <div class="fs-2 fw-semibold">{{ $stats['low_stock'] }}</div>
        </div></div>
    </div>
</div>

<h6>Produk Stok Menipis</h6>
<table class="table table-bordered bg-white">
    <thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th class="text-end">Stok</th><th class="text-end">Minimum</th></tr></thead>
    <tbody>
    @forelse($lowStock as $p)
        <tr>
            <td>{{ $p->product_code }}</td>
            <td>{{ $p->product_name }}</td>
            <td>{{ $p->category->category_name }}</td>
            <td class="text-end">{{ $p->current_stock + 0 }} {{ $p->unit }}</td>
            <td class="text-end">{{ $p->minimum_stock + 0 }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center text-muted">Semua stok aman.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection