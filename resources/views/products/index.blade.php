@extends('layouts.app')
@section('title', 'Products')
@section('content')
@php $isAdmin = auth()->user()->role === 'admin'; @endphp
<div class="d-flex justify-content-between mb-3">
    <h4>Products</h4>
    @if($isAdmin) <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a> @endif
</div>
<form method="GET" class="mb-3 d-flex gap-2" style="max-width:400px">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari kode atau nama">
    <button class="btn btn-outline-secondary">Cari</button>
</form>
<table class="table table-bordered bg-white">
    <thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Min.</th><th>Status</th><th width="190">Aksi</th></tr></thead>
    <tbody>
    @forelse($products as $p)
        <tr>
            <td>{{ $p->product_code }}</td>
            <td>{{ $p->product_name }}</td>
            <td>{{ $p->category->category_name }}</td>
            <td>{{ $p->current_stock + 0 }} {{ $p->unit }}</td>
            <td>{{ $p->minimum_stock + 0 }}</td>
            <td>
                <span class="badge {{ $p->stock_status === 'Aman' ? 'bg-success' : ($p->stock_status === 'Menipis' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ $p->stock_status }}</span>
            </td>
            <td>
                <a href="{{ route('products.show', $p) }}" class="btn btn-sm btn-info">Detail</a>
                @if($isAdmin)
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $p) }}" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center text-muted">Belum ada produk.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $products->links('pagination::bootstrap-5') }}
@endsection