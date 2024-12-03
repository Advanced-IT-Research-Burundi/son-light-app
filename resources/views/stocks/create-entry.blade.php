@extends('layouts.app')

@section('title', 'Entrée de stock')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-box-arrow-in-down"></i> Entrée de stock
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('stocks.storeEntry') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="product_id" class="form-label">Sélectionner le produit</label>
                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">Choisir un produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }} ({{ $product->code }})</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="quantity_entered" class="form-label">Quantité entrante</label>
                        <input type="number" class="form-control @error('quantity_entered') is-invalid @enderror" id="quantity_entered" name="quantity_entered" value="{{ old('quantity_entered') }}" required min="1">
                        @error('quantity_entered')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="entry_date" class="form-label">Date d'entrée</label>
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required>
                        @error('entry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-6">
                        <label for="supplier" class="form-label">Fournisseur</label>
                        <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" value="{{ old('supplier') }}">
                        @error('supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="entry_notes" class="form-label">Notes d'entrée</label>
                    <textarea class="form-control @error('entry_notes') is-invalid @enderror" id="entry_notes" name="entry_notes" rows="3">{{ old('entry_notes') }}</textarea>
                    @error('entry_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Enregistrer l'entrée
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
