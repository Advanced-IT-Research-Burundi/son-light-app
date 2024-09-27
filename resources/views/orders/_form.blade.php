<!-- resources/views/orders/_form.blade.php -->

<div class="form-group mb-3">
    <label for="client_id" class="form-label">
        <i class="bi bi-person"></i> Client
    </label>
    <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
        <option value="">Sélectionnez un client</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ old('client_id', $order->client_id ?? '') == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="order_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de commande
    </label>
    <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date ?? '') }}" required>
    @error('order_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="amount" class="form-label">
        BIF Montant
    </label>
    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $order->amount ?? '') }}" required>
    @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="status" class="form-label">
        <i class="bi bi-check2-circle"></i> Statut
    </label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="">Sélectionnez un statut</option>
        <option value="pending" {{ old('status', $order->status ?? '') == 'pending' ? 'selected' : '' }}>En attente</option>
        <option value="processing" {{ old('status', $order->status ?? '') == 'processing' ? 'selected' : '' }}>En cours</option>
        <option value="completed" {{ old('status', $order->status ?? '') == 'completed' ? 'selected' : '' }}>Terminée</option>
        <option value="cancelled" {{ old('status', $order->status ?? '') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
    </select>
    @error('status')
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