@extends('layouts.app')

@section('title', 'Sortie de stock')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-box-arrow-out-up"></i> Sortie de stock
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('stocks.storeExit') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="product_id" class="form-label">Sélectionner le produit</label>
                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">Choisir un produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-available-quantity="{{ $product->quantity }}">
                                    {{ $product->product_name }} ({{ $product->code }}) - Disponible: {{ $product->quantity }} {{ $product->unit }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="quantity_exited" class="form-label">Quantité sortante</label>
                        <input type="number" class="form-control @error('quantity_exited') is-invalid @enderror" id="quantity_exited" name="quantity_exited" value="{{ old('quantity_exited') }}" required min="1" max="" data-max-quantity>
                        @error('quantity_exited')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="exit_date" class="form-label">Date de sortie</label>
                        <input type="date" class="form-control @error('exit_date') is-invalid @enderror" id="exit_date" name="exit_date" value="{{ old('exit_date', date('Y-m-d')) }}" required>
                        @error('exit_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="destination" class="form-label">Destination/Destinataire</label>
                        <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" value="{{ old('destination') }}">
                        @error('destination')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exit_notes" class="form-label">Notes de sortie</label>
                    <textarea class="form-control @error('exit_notes') is-invalid @enderror" id="exit_notes" name="exit_notes" rows="3">{{ old('exit_notes') }}</textarea>
                    @error('exit_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-check-lg"></i> Enregistrer la sortie
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity_exited');

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const maxQuantity = selectedOption.getAttribute('data-available-quantity');
        quantityInput.setAttribute('max', maxQuantity);
        quantityInput.value = '';
    });
});
</script>
@endpush
@endsection
