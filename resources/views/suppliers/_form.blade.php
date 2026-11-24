<div class="mb-3">
    <label class="form-label">Nama Supplier</label>
    <input type="text" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name ?? '') }}"
           class="form-control @error('supplier_name') is-invalid @enderror">
    @error('supplier_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Contact Person</label>
    <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
           class="form-control @error('contact_person') is-invalid @enderror">
    @error('contact_person') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}"
               class="form-control @error('phone') is-invalid @enderror">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $supplier->email ?? '') }}"
               class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $supplier->address ?? '') }}</textarea>
    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>