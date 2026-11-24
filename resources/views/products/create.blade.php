@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
<h4>Tambah Produk</h4>
<form method="POST" action="{{ route('products.store') }}" class="card card-body" style="max-width:600px">
    @csrf
    @include('products._form')
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection