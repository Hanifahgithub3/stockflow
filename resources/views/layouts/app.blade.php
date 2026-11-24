
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'StockFlow') - Inventory Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #234b3c;
            --primary-dark: #19382d;
            --background: #f6f7f3;
            --sidebar-width: 250px;
            --text: #263b31;
            --muted: #89958d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: "Segoe UI", sans-serif;
            color: var(--text);
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-dark);
            position: fixed;
            top: 0;
            left: 0;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand {
            font-size: 23px;
            font-weight: 700;
            color: white;
            padding: 0 12px;
            margin-bottom: 45px;
            text-decoration: none;
        }

        .brand span {
            color: #a9c9b3;
        }

        .menu-label {
            color: #91aa9b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar .nav-link {
            color: #c1d0c5;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 5px;
            transition: .2s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: white;
        }

        .sidebar .nav-link.active {
            background: #315c49;
            color: white;
            font-weight: 600;
        }

        .menu-icon {
            display: inline-block;
            width: 25px;
            font-size: 15px;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.12);
            padding-top: 18px;
        }

        .user-info {
            color: white;
            font-size: 13px;
            padding: 0 10px;
        }

        .user-info small {
            display: block;
            color: #a9c1b0;
            font-size: 11px;
            margin-top: 4px;
            text-transform: capitalize;
        }

        .logout-btn {
            width: 100%;
            margin-top: 16px;
            border: 1px solid rgba(255,255,255,.2);
            color: #d4e1d7;
            font-size: 12px;
            padding: 9px;
            border-radius: 8px;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,.1);
            color: white;
        }

        /* MAIN CONTENT */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #edf0ec;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar-title {
            font-weight: 600;
            font-size: 14px;
            color: var(--text);
        }

        .topbar-subtitle {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .topbar-user {
            background: #e7f0e9;
            color: var(--primary);
            border-radius: 9px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 600;
        }

        .main-content {
            padding: 32px 35px;
        }

        /* FLASH MESSAGE */
        .alert {
            border: none;
            border-radius: 10px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 190px;
            }

            .sidebar {
                padding: 20px 10px;
            }

            .main-content {
                padding: 22px 16px;
            }

            .topbar {
                padding: 0 18px;
            }
        }

        @media (max-width: 576px) {
            :root {
                --sidebar-width: 65px;
            }

            .sidebar {
                padding: 20px 7px;
            }

            .brand {
                font-size: 0;
                padding: 0;
                text-align: center;
            }

            .brand::before {
                content: "S";
                font-size: 23px;
            }

            .menu-label,
            .nav-text,
            .user-info,
            .logout-text {
                display: none;
            }

            .sidebar .nav-link {
                text-align: center;
                padding: 12px 5px;
                font-size: 17px;
            }

            .menu-icon {
                width: auto;
            }

            .topbar {
                height: 65px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $isAdmin = $user->role === 'admin';
@endphp

<!-- SIDEBAR -->
<aside class="sidebar">

    <a href="{{ route('dashboard') }}" class="brand">
        Stock<span>Flow</span>
    </a>

    <div class="menu-label">MAIN MENU</div>

    <nav class="nav flex-column">

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">▦</span>
            <span class="nav-text">Dashboard</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <span class="menu-icon">▤</span>
            <span class="nav-text">Products</span>
        </a>

        @if($isAdmin)

            <a href="{{ route('categories.index') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <span class="menu-icon">▧</span>
                <span class="nav-text">Categories</span>
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                <span class="menu-icon">♙</span>
                <span class="nav-text">Suppliers</span>
            </a>

            <a href="{{ route('purchase-orders.index') }}"
               class="nav-link {{ request()->routeIs('purchase-orders.*') ? 'active' : '' }}">
                <span class="menu-icon">▣</span>
                <span class="nav-text">Purchase Orders</span>
            </a>

        @endif

    </nav>

    <div class="sidebar-footer">

        <div class="user-info">
            {{ $user->name }}
            <small>{{ $user->role }}</small>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn logout-btn">
                <span class="logout-text">Logout ↗</span>
                <span class="d-none d-sm-inline"> </span>
            </button>
        </form>

    </div>

</aside>

<!-- MAIN -->
<div class="main-wrapper">

    <header class="topbar">

        <div>
            <div class="topbar-title">
                @yield('title', 'Dashboard')
            </div>
            <div class="topbar-subtitle">
                StockFlow / @yield('title', 'Dashboard')
            </div>
        </div>

        <div class="topbar-user">
            {{ $user->name }}
        </div>

    </header>

    <main class="main-content">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>
