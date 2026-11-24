
<div class="mb-4">

    <label class="form-label">Kategori Produk</label>

    <select
        name="category_id"
        class="form-select @error('category_id') is-invalid @enderror"
    >
        <option value="">Pilih kategori produk</option>

        @foreach($categories as $c)
            <option
                value="{{ $c->id }}"
                @selected(old('category_id', $product->category_id ?? '') == $c->id)
            >
                {{ $c->category_name }}
            </option>
        @endforeach

    </select>

    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="mb-4">

    <label class="form-label">Kode Produk (SKU)</label>

    <input
        type="text"
        name="product_code"
        placeholder="Contoh: PRD-001"
        value="{{ old('product_code', $product->product_code ?? '') }}"
        class="form-control @error('product_code') is-invalid @enderror"
    >

    <div class="form-text">
        Gunakan kode unik untuk mengidentifikasi produk.
    </div>

    @error('product_code')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="mb-4">

    <label class="form-label">Nama Produk</label>

    <input
        type="text"
        name="product_name"
        placeholder="Masukkan nama produk"
        value="{{ old('product_name', $product->product_name ?? '') }}"
        class="form-control @error('product_name') is-invalid @enderror"
    >

    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label">Satuan Produk</label>

        <input
            type="text"
            name="unit"
            placeholder="Contoh: kg, pcs, liter"
            value="{{ old('unit', $product->unit ?? '') }}"
            class="form-control @error('unit') is-invalid @enderror"
        >

        @error('unit')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label">Stok Minimum</label>

        <input
            type="number"
            step="0.01"
            name="minimum_stock"
            placeholder="0"
            value="{{ old('minimum_stock', $product->minimum_stock ?? 0) }}"
            class="form-control @error('minimum_stock') is-invalid @enderror"
        >

        <div class="form-text">
            Batas minimum stok sebelum dianggap menipis.
        </div>

        @error('minimum_stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>
