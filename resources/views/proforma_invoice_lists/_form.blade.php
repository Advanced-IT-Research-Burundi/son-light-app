<!-- resources/views/detail_orders/_form.blade.php -->

<div class="mb-3">
    <label for="product_name" class="form-label">Nom de l'article ou service</label>
    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $proformaInvoiceList->product_name ?? '') }}" required>
    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="unit" class="form-label">Unité</label>
    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $proformaInvoiceList->unit ?? '') }}" >
    @error('unit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="quantity" class="form-label">Quantité</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $proformaInvoiceList->quantity ?? '') }}" required min="1">
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="unit_price" class="form-label">Prix unitaire</label>
    <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price', $proformaInvoiceList->unit_price ?? '') }}" required min="0">
    @error('unit_price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>