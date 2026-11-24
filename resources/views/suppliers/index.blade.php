
@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')

<style>
    .page-header {
        margin-bottom: 26px;
    }

    .page-header h4 {
        font-weight: 700;
        color: #263b31;
        margin-bottom: 6px;
    }

    .page-header p {
        font-size: 13px;
        color: #89958d;
        margin: 0;
    }

    .btn-add {
        background: #234b3c;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add:hover {
        background: #19382d;
        color: white;
    }

    .search-box {
        background: white;
        border: 1px solid #e8ede8;
        border-radius: 9px;
        padding: 9px 13px;
        font-size: 13px;
        min-width: 250px;
    }

    .search-box:focus {
        border-color: #8ca997;
        box-shadow: 0 0 0 3px rgba(35, 75, 60, .08);
        outline: none;
    }

    .btn-search {
        background: #e7f0e9;
        color: #32674d;
        border: none;
        border-radius: 9px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-search:hover {
        background: #d8e8dc;
    }

    .supplier-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .supplier-card-header {
        padding: 19px 22px;
        border-bottom: 1px solid #edf0ec;
    }

    .supplier-card-header h6 {
        color: #263b31;
        font-weight: 700;
        margin: 0;
    }

    .supplier-table {
        margin: 0;
    }

    .supplier-table thead th {
        background: #f8faf7;
        color: #89958d;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
        padding: 15px 18px;
        border: none;
        white-space: nowrap;
    }

    .supplier-table tbody td {
        padding: 17px 18px;
        font-size: 13px;
        color: #647168;
        vertical-align: middle;
        border-color: #f0f2ef;
    }

    .supplier-name {
        color: #263b31;
        font-weight: 600;
    }

    .contact-name {
        color: #526057;
        font-weight: 500;
    }

    .contact-info {
        color: #647168;
    }

    .action-btn {
        font-size: 11px;
        padding: 7px 12px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-edit {
        background: #fff2df;
        color: #ad792e;
    }

    .btn-delete {
        background: #fce8e7;
        color: #b94c45;
    }

    .action-btn:hover {
        opacity: .8;
    }

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: #89958d;
        font-size: 13px;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        color: #32674d;
        border-color: #edf0ec;
        font-size: 12px;
    }

    .pagination .active .page-link {
        background: #234b3c;
        border-color: #234b3c;
        color: white;
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">

    <div>
        <h4>Suppliers</h4>
        <p>Kelola data supplier dan informasi kontak pemasok.</p>
    </div>

    <a href="{{ route('suppliers.create') }}" class="btn-add">
        + Tambah Supplier
    </a>

</div>

<!-- SEARCH -->
<form method="GET" class="d-flex gap-2 flex-wrap mb-4">

    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        class="search-box"
        placeholder="Cari nama atau kontak supplier..."
    >

    <button type="submit" class="btn-search">
        Cari
    </button>

</form>

<!-- SUPPLIER TABLE -->
<div class="supplier-card">

    <div class="supplier-card-header d-flex justify-content-between align-items-center">

        <h6>Daftar Supplier</h6>

        <span class="text-muted small">
            {{ $suppliers->total() }} supplier terdaftar
        </span>

    </div>

    <div class="table-responsive">

        <table class="table supplier-table">

            <thead>
                <tr>
                    <th>Nama Supplier</th>
                    <th>Contact Person</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($suppliers as $s)

                    <tr>

                        <td>
                            <span class="supplier-name">
                                {{ $s->supplier_name }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-name">
                                {{ $s->contact_person }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-info">
                                {{ $s->phone }}
                            </span>
                        </td>

                        <td>
                            <span class="contact-info">
                                {{ $s->email }}
                            </span>
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('suppliers.edit', $s) }}"
                                    class="action-btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('suppliers.destroy', $s) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Hapus supplier ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="action-btn btn-delete">
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                Belum ada supplier yang terdaftar.
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-3 border-top d-flex justify-content-end">
        {{ $suppliers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
