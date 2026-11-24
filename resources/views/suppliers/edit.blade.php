@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<h4>Edit Supplier</h4>
<form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="card card-body" style="max-width:600px">
    @csrf @method('PUT')
    @include('suppliers._form')
    <button class="btn btn-primary">Perbarui</button>
</form>
@endsection