<!-- resources/views/detail_orders/_form.blade.php -->
<div class="row">
<div class="mb-3 col-6">
    <label for="product_name" class="form-label">Nom de l'article ou du service</label>
    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $detailOrder->product_name ?? '') }}" required>
    @error('product_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-6">
    <label for="unit" class="form-label">Unité</label>
    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $detailOrder->unit ?? '') }}" >
    @error('unit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
  <div class="mb-3 col-6">
    <label for="quantity" class="form-label">Quantité</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $detailOrder->quantity ?? '') }}" required min="1">
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-6">
    <label for="unit_price" class="form-label">Prix unitaire</label>
    <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price', $detailOrder->unit_price ?? '') }}" required min="0">
    @error('unit_price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
    <div class="mb-3 col-4">
      <label for="tc" class="form-label">TC</label>
      <input type="number" class="form-control @error('tc') is-invalid @enderror" id="tc" name="tc" value="{{ old('tc', $detailOrder->tc ?? '') }}">
      @error('tc')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>
  <div class="mb-3 col-4">
      <label for="atax" class="form-label">A.TAX</label>
      <input type="number" class="form-control @error('atax') is-invalid @enderror" id="atax" name="atax" value="{{ old('atax', $detailOrder->atax ?? '') }}">
      @error('atax')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>
  <div class="mb-3 col-4">
    <label for="pf" class="form-label">PF</label>
    <input type="number" class="form-control @error('pf') is-invalid @enderror" id="pf" name="pf" value="{{ old('pf', $detailOrder->pf ?? '') }}">
    @error('pf')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
  </div>
