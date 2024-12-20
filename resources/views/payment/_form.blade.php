<!-- resources/views/invoices/_form.blade.php -->
@csrf
<div class="row">
<div class="form-group mb-3 col-6">
    <label for="invoice_id" class="form-label">
        <i class="bi bi-person"></i> Facture
    </label>
    <select class="form-select @error('invoice_id') is-invalid @enderror" id="invoice_id" name="invoice_id" required>
        <option value="">Sélectionnez une facture</option>
        @foreach($invoices as $invoice)
            <option value="{{ $invoice->id }}" {{ old('invoice_id', $invoice->id ?? '') == $payment->invoice_id ? 'selected' : '' }}>
                #{{$invoice->number}} | {{$invoice->order->designation}} | {{ $invoice?->order?->client?->name??'' }} | {{ $invoice?->order?->entreprise?->name ?? '' }}
        @endforeach
    </select>
    @error('invoice_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-6">
    <label for="amount" class="form-label">
        <i class="bi bi-cash-coin"></i> Montant
    </label>
    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $payment->amount ?? '') }}" required>
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
 <div class="form-group mb-3 col-6">
    <label for="payment_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de payement
    </label>
    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date ?? '') }}" required>
 @error('payment_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-6">
    <label for="payment_method" class="form-label">
        <i class="bi bi-calendar"></i> Mode de payement
    </label>
    <select name="payment_method" class="form-control">
        <option value="">Sélectionnez le mode de paiement</option>
        <option value="En espece" @if(old('payment_method', $payment->payment_method) == 'En espece') selected @endif>En espece</option>
        <option value="Banque" @if(old('payment_method', $payment->payment_method) == 'Banque') selected @endif>Banque</option>
        <option value="Electronique" @if(old('payment_method', $payment->payment_method) == 'Electronique') selected @endif>Électronique</option>
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
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $payment->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
