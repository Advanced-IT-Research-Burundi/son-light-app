<!-- resources/views/orders/_form.blade.php -->
@csrf
<div class="form-group mb-4">
    <label for="order_id" class="mb-2"><i class="bi bi-cart3"></i> Commande</label>
    <select name="order_id" id="order_id" class="form-control @error('order_id') is-invalid @enderror" required>
        <option value="">Sélectionnez une commande</option>
        @foreach($orders as $order)
            <option value="{{ $order->id }}" {{ isset($task) && $task->order_id == $order->id ? 'selected' : '' }}>#{{ $order->id }}   : {{ $order->designation }}</option>
        @endforeach
    </select>
    @error('order_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="amount" class="form-label">
        <i class="bi bi-cash-coin"></i> Montant
    </label>
    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $order->amount ?? '') }}" required>
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="payment_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de payement
    </label>
    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $order->payment_date ?? '') }}" required>
    @error('payment_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
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


<div class="form-group mb-3">
    <label for="description" class="form-label">
        <i class="bi bi-text-paragraph"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $order->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
