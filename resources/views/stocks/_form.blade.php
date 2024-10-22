<div class="row">
<!-- resources/views/stocks/_form.blade.php -->

<div class="mb-3 col-3">
    <label for="product_name" class="form-label">Nom du produit</label>
    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $stock->product_name ?? '') }}" required>
    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 col-2">
    <label for="code" class="form-label">Code</label>
    <input type="text" class="form-control @error('sku') is-invalid @enderror" id="code" name="code" value="{{ old('code', $stock->code ?? '') }}" required>
    @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 col-2">
    <label for="quantity" class="form-label">Quantité</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $stock->quantity ?? 0) }}" required min="0">
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 col-2">
    <label for="unit" class="form-label">Unité</label>
    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $stock->unit ?? '') }}" required>
    @error('unit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3 col-3">
    <label for="min_quantity" class="form-label">Quantité minimale</label>
    <input type="number" class="form-control @error('min_quantity') is-invalid @enderror" id="min_quantity" name="min_quantity" value="{{ old('min_quantity', $stock->min_quantity ?? 0) }}" required min="0">
    @error('min_quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $stock->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>