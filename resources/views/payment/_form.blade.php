<!-- resources/views/orders/_form.blade.php -->
@csrf
<div class="row">
<div class="form-group mb-3 col-3">
    <label for="invoice_id" class="form-label">
        <i class="bi bi-person"></i> Facture
    </label>
    <select class="form-select @error('order_id') is-invalid @enderror" id="order_id" name="invoice_id" required>
        <option value="">Sélectionnez une facture</option>
        @foreach($orders as $order)
            <option value="{{ $order->id }}" {{ old('order_id', $order->id ?? '') == $order->id ? 'selected' : '' }}>
                # {{ $order->id }}   {{$order->number}}
            </option>
        @endforeach
    </select>
    @error('invoice_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-3">
    <label for="amount" class="form-label">
        <i class="bi bi-cash-coin"></i> Montant
    </label>
    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $invoice->order->amount ?? '') }}" required>
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-3">
    <label for="payment_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de payement
    </label>
    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $invoice->payment_date ?? '') }}" required>
    @error('payment_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-3">
    <label for="payment_method" class="form-label">
        <i class="bi bi-calendar"></i> Mode de payement
    </label>
    <select name="payment_method" id="" class="form-control">
        <option value="">Séléction le mode de payement</option>
        <option value="En espece">En espece</option>
        <option value="Banque">Banque</option>
        <option value="Electronique">Eléctronique</option>

    </select>
    @error('payment_method')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="form-group mb-3">
    <label for="description" class="form-label">
        <i class="bi bi-text-paragraph"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $order->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
