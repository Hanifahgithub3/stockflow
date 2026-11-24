<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'StockFlow')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('dashboard') }}">StockFlow</a>
    <div class="navbar-nav me-auto">
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            <a class="nav-link" href="{{ route('suppliers.index') }}">Suppliers</a>
        @endif
    </div>
    <span class="navbar-text me-3">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-sm btn-outline-light">Logout</button>
    </form>
</nav>
<div class="container py-4">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @yield('content')
</div>
</body>
</html>