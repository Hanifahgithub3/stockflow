@extends('layouts.app')
@section('title', 'Tambah Supplier')
@section('content')
<h4>Tambah Supplier</h4>
<form method="POST" action="{{ route('suppliers.store') }}" class="card card-body" style="max-width:600px">
    @csrf
    @include('suppliers._form')
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection