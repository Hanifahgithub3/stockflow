@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<h4>Edit Produk</h4>
<form method="POST" action="{{ route('products.update', $product) }}" class="card card-body" style="max-width:600px">
    @csrf @method('PUT')
    @include('products._form')
    <button class="btn btn-primary">Perbarui</button>
</form>
@endsection