@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Suppliers</h4>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah Supplier</a>
</div>
<form method="GET" class="mb-3 d-flex gap-2" style="max-width:400px">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama atau kontak">
    <button class="btn btn-outline-secondary">Cari</button>
</form>
<table class="table table-bordered bg-white">
    <thead><tr><th>Nama</th><th>Contact Person</th><th>Telepon</th><th>Email</th><th width="170">Aksi</th></tr></thead>
    <tbody>
    @forelse($suppliers as $s)
        <tr>
            <td>{{ $s->supplier_name }}</td>
            <td>{{ $s->contact_person }}</td>
            <td>{{ $s->phone }}</td>
            <td>{{ $s->email }}</td>
            <td>
                <a href="{{ route('suppliers.edit', $s) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('suppliers.destroy', $s) }}" class="d-inline" onsubmit="return confirm('Hapus supplier ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center text-muted">Belum ada supplier.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $suppliers->links('pagination::bootstrap-5') }}
@endsection