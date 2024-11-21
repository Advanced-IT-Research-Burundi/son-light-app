<!-- resources/views/orders/_form.blade.php -->
<input type="hidden" name="proforma_invoice_id" value="{{ $proforma_invoice->id }}">
<input type="hidden" name="client_id" value="{{ $proforma_invoice->client->id }}">
<input type="hidden" name="company_id" value="{{ $proforma_invoice->entreprise->id }}">
<input type="hidden" name="designation" value="{{ $proforma_invoice->designation }}">

<div class="form-group mb-3">
    <div class="row">
        <div class="mb-3 col-6">
            <label for="client_name" class="form-label"><i class="bi bi-person"></i> Client</label>
            <input type="text" class="form-control" id="client_name" name="" value="{{ $proforma_invoice->client->name }}" readonly>
        </div>
        <div class="mb-3 col-6">
            <label for="company_name"><i class="bi bi-people-fill"></i> Entreprise</label>
            <input type="text" class="form-control" id="company_name" name="" value="{{ $proforma_invoice->entreprise->name }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="designation_display"><i class="bi bi-calendar"></i> Désignation</label>
            <input type="text" class="form-control" id="designation_display" name="" value="{{ $proforma_invoice->designation }}" readonly>
        </div>
        <div class="mb-3 col-6">
            <label for="unit" class="form-label">Unité</label>
            <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $order?->unit ?? $proforma_invoice->unit ?? '') }}">
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="amount" class="form-label"><i class="bi bi-cash-coin"></i> P.U</label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $order?->amount ?? $proforma_invoice->amount ?? '') }}" required data-calc="price">
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $order?->quantity ?? $proforma_invoice->quantity ?? '') }}" required data-calc="quantity">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="amount_ht" class="form-label">Montant HT</label>
            <input type="text" class="form-control" id="amount_ht" name="amount_ht" readonly>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="amount_tvac" class="form-label">Montant TTC</label>
            <input type="text" class="form-control" id="amount_tvac" name="amount_tvac" readonly>
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="tva" class="form-label">TVA</label>
            <select class="form-select @error('tva') is-invalid @enderror" id="tva" name="tva" required data-calc="tva">
                <option value="">Sélectionnez un taux</option>
                @foreach(TVA_RANGE as $rate)
                    <option value="{{ $rate }}" {{ old('tva', $order->tva ?? '') == $rate ? 'selected' : '' }}>{{ $rate }}%</option>
                @endforeach
            </select>
            @error('tva')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="delivery_date" class="form-label"><i class="bi bi-calendar"></i> Date de livraison</label>
            <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $order->delivery_date ?? '') }}" required>
            @error('delivery_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <div class="form-group mb-3 col-6">
            <label for="status_livraison" class="form-label"><i class="bi bi-check2-circle"></i> Statut de la livraison</label>
            <select class="form-select @error('status_livraison') is-invalid @enderror" id="status_livraison" name="status_livraison" required>
                <option value="">Sélectionnez un statut</option>
                <option value="2" {{ old('status_livraison', $order->status_livraison ?? '') == 2 ? 'selected' : '' }}>En attente</option>
                <option value="1" {{ old('status_livraison', $order->status_livraison ?? '') == 1 ? 'selected' : '' }}>Immédiatement</option>
                <option value="3" {{ old('status_livraison', $order->status_livraison ?? '') == 3 ? 'selected' : '' }}>Terminée</option>
            </select>
            @error('status_livraison')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="status" class="form-label"><i class="bi bi-check2-circle"></i> Statut de la commande</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">Sélectionnez un statut</option>
                <option value="En attente" {{ old('status', $order->status ?? '') == 'En attente' ? 'selected' : '' }}>En attente</option>
                <option value="En cours" {{ old('status', $order->status ?? '') == 'En cours' ? 'selected' : '' }}>En cours</option>
                <option value="Terminée" {{ old('status', $order->status ?? '') == 'Terminée' ? 'selected' : '' }}>Terminée</option>
                <option value="Annulée" {{ old('status', $order->status ?? '') == 'Annulée' ? 'selected' : '' }}>Annulée</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
     <div class="form-group mb-3  col-12">
     <label for="delivery_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de la commande
    </label>
    <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date ?? '') }}" required>
    @error('order_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
    </div>

    <div class="form-group mb-3">
        <label for="description" class="form-label"><i class="bi bi-text-paragraph"></i> Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $order->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const price = document.querySelector('[data-calc="price"]');
    const quantity = document.querySelector('[data-calc="quantity"]');
    const tva = document.querySelector('[data-calc="tva"]');
    const amountHt = document.getElementById('amount_ht');
    const amountTvac = document.getElementById('amount_tvac');

    function calculateAmounts() {
        const priceValue = parseFloat(price.value) || 0;
        const quantityValue = parseInt(quantity.value) || 0;
        const tvaRate = parseFloat(tva.value) || 0;

        const totalHt = priceValue * quantityValue;
        const totalTvac = totalHt * (1 + tvaRate / 100);

        amountHt.value = totalHt.toFixed(2);
        amountTvac.value = totalTvac.toFixed(2);
    }

    [price, quantity, tva].forEach(element => {
        element.addEventListener('input', calculateAmounts);
    });

    // Initial calculation
    calculateAmounts();
});
</script>
@stop