@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Categories</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
</div>
<table class="table table-bordered bg-white">
    <thead><tr><th>#</th><th>Nama Kategori</th><th width="180">Aksi</th></tr></thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline"
                      onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="3" class="text-center text-muted">Belum ada kategori.</td></tr>
    @endforelse
    </tbody>
</table>
{{ $categories->links('pagination::bootstrap-5') }}
@endsection
