
@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<style>
    .page-header {
        margin-bottom: 28px;
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

    .category-card {
        background: white;
        border: 1px solid #edf0ec;
        border-radius: 14px;
        overflow: hidden;
    }

    .category-card-header {
        padding: 19px 22px;
        border-bottom: 1px solid #edf0ec;
    }

    .category-card-header h6 {
        color: #263b31;
        font-weight: 700;
        margin: 0;
    }

    .category-table {
        margin: 0;
    }

    .category-table thead th {
        background: #f8faf7;
        color: #89958d;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
        padding: 15px 20px;
        border: none;
    }

    .category-table tbody td {
        padding: 17px 20px;
        font-size: 13px;
        color: #526057;
        vertical-align: middle;
        border-color: #f0f2ef;
    }

    .category-number {
        background: #e7f0e9;
        color: #32674d;
        width: 30px;
        height: 30px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }

    .category-name {
        color: #263b31;
        font-weight: 600;
    }

    .action-btn {
        font-size: 11px;
        padding: 7px 12px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        font-weight: 600;
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
        <h4>Categories</h4>
        <p>Kelola dan atur pengelompokan produk inventory.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn-add">
        + Tambah Kategori
    </a>

</div>

<!-- CATEGORY TABLE -->
<div class="category-card">

    <div class="category-card-header d-flex justify-content-between align-items-center">

        <h6>Daftar Kategori</h6>

        <span class="text-muted small">
            {{ $categories->total() }} kategori terdaftar
        </span>

    </div>

    <div class="table-responsive">

        <table class="table category-table">

            <thead>
                <tr>
                    <th width="80">No.</th>
                    <th>Nama Kategori</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>
                            <span class="category-number">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </span>
                        </td>

                        <td>
                            <span class="category-name">
                                {{ $category->category_name }}
                            </span>
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a href="{{ route('categories.edit', $category) }}"
                                   class="action-btn btn-edit">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('categories.destroy', $category) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Hapus kategori ini?')"
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
                        <td colspan="3">
                            <div class="empty-state">
                                Belum ada kategori yang terdaftar.
                            </div>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-3 border-top d-flex justify-content-end">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
    