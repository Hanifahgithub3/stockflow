@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('content')
<h4>Tambah Kategori</h4>
<form method="POST" action="{{ route('categories.store') }}" class="card card-body" style="max-width:500px">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="category_name" value="{{ old('category_name') }}"
               class="form-control @error('category_name') is-invalid @enderror">
        @error('category_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection