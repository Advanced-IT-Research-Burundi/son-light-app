<div class="form-group mb-3 col-12">
    <label for="cash_register_id" class="form-label">
        <i class="bi bi-cash-coin"></i> Caisse
    </label>
    <select class="form-select @error('cash_register_id') is-invalid @enderror" id="cash_register_id" name="cash_register_id" required>
        <option value="">Sélectionnez une caisse</option>
        @foreach($cashs as $cashRegister)
            <option value="{{ $cashRegister->id }}" {{ old('cash_register_id', $cash_register_id ?? '') == $cashRegister->id ? 'selected' : '' }}>
                Caisse Numéro #{{ $cashRegister?->id }} || Montant de {{ number_format($cashRegister->opening_balance, 2) }} BIF || Créé le {{ $cashRegister->created_at->format('d/m/Y H:i:s') }} || Auteur de la création : {{ optional($cashRegister->creator)->name ?? 'Inconnu' }}
            </option>
        @endforeach
    </select>
    @error('cash_register_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="denomination">Dénomination</label>
    <select name="denomination" class="form-control" required>
        <option value="">Sélectionner Dénomination</option>
        <option value="10000" {{ isset($denomination) && $denomination->denomination == '10000' ? 'selected' : '' }}>10000</option>
        <option value="5000" {{ isset($denomination) && $denomination->denomination == '5000' ? 'selected' : '' }}>5000</option>
        <option value="2000" {{ isset($denomination) && $denomination->denomination == '2000' ? 'selected' : '' }}>2000</option>
        <option value="1000" {{ isset($denomination) && $denomination->denomination == '1000' ? 'selected' : '' }}>1000</option>
        <option value="500" {{ isset($denomination) && $denomination->denomination == '500' ? 'selected' : '' }}>500</option>
        <option value="100" {{ isset($denomination) && $denomination->denomination == '100' ? 'selected' : '' }}>100</option>
        <option value="50" {{ isset($denomination) && $denomination->denomination == '50' ? 'selected' : '' }}>50</option>
    </select>
</div>
<div class="form-group">
    <label for="quantity">Quantité</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', isset($denomination) ? $denomination->quantity : '') }}" required>
</div>
