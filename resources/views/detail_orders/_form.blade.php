<!-- resources/views/detail_orders/_form.blade.php -->

<div class="mb-3">
    <label for="product_name" class="form-label">Nom du produit</label>
    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $detailOrder->product_name ?? '') }}" required>
    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="quantity" class="form-label">Quantité</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $detailOrder->quantity ?? '') }}" required min="1">
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="unit_price" class="form-label">Prix unitaire</label>
    <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price', $detailOrder->unit_price ?? '') }}" required min="0">
    @error('unit_price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>