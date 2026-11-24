@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')
<h4>{{ $product->product_name }}</h4>
<table class="table table-bordered bg-white" style="max-width:600px">
    <tr><th width="200">Kode (SKU)</th><td>{{ $product->product_code }}</td></tr>
    <tr><th>Kategori</th><td>{{ $product->category->category_name }}</td></tr>
    <tr><th>Satuan</th><td>{{ $product->unit }}</td></tr>
    <tr><th>Stok Saat Ini</th><td>{{ $product->current_stock + 0 }} {{ $product->unit }}</td></tr>
    <tr><th>Stok Minimum</th><td>{{ $product->minimum_stock + 0 }} {{ $product->unit }}</td></tr>
    <tr><th>Status</th><td>{{ $product->stock_status }}</td></tr>
</table>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
@endsection