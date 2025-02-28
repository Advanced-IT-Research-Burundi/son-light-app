<!-- resources/views/orders/_form.blade.php -->
<div class="row">
    <div class="form-group mb-3 col-6">
        <label for="client_id" class="form-label">
            <i class="bi bi-person"></i> Client
        </label>
        <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required aria-required="true">
            <option value="" disabled selected>Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ old('client_id', $proforma_invoice->client_id ?? '') == $client->id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>
        @error('client_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3 col-6">
        <label for="company_id" class="form-label">
            <i class="bi bi-people-fill"></i> Entreprise
        </label>
        <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required aria-required="true">
            <option value="" disabled selected>Sélectionnez une entreprise</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('company_id', $proforma_invoice->company_id ?? '') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        @error('company_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="form-group mb-3 col-6">
        <label for="designation" class="form-label">
            <i class="bi bi-calendar"></i> Désignation
        </label>
        <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $proforma_invoice->designation ?? '') }}" required aria-required="true" placeholder="Désignation" />
        @error('designation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3 col-6">
        <label for="unit" class="form-label">
            <i class="bi bi-unit"></i> Unité de Mesure
        </label>
        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $proforma_invoice->unit ?? '') }}" placeholder="Unité" />
        @error('unit')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="mb-3 col-6">
        <label for="validity_period" class="form-label">Période de validité (en jours)</label>
        <input type="number" class="form-control @error('validity_period') is-invalid @enderror" id="validity_period" name="validity_period" value="{{ old('validity_period', $proforma_invoice->validity_period ?? 30) }}" required aria-required="true" min="1" placeholder="Nombre de jours" />
        @error('validity_period')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3 col-6">
        <label for="amount" class="form-label">
            <i class="bi bi-cash-coin"></i> Prix Unitaire
        </label>
        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $proforma_invoice->amount ?? '') }}" required aria-required="true" data-calc="price" placeholder="Prix unitaire" />
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="form-group mb-3 col-6">
        <label for="quantity" class="form-label">Quantité</label>
        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $proforma_invoice->quantity ?? '') }}" required aria-required="true" data-calc="quantity" placeholder="Quantité" />
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3 col-6">
        <label for="tva" class="form-label">TVA</label>
        <select class="form-select @error('tva') is-invalid @enderror" id="tva" name="tva" required aria-required="true" data-calc="tva">
            <option value="" disabled selected>Sélectionnez un taux</option>
            @foreach(TVA_RANGE as $rate)
                <option value="{{ $rate }}" {{ old('tva', $proforma_invoice->tva ?? '') == $rate ? 'selected' : '' }}>
                    {{ $rate }}%
                </option>
            @endforeach
        </select>
        @error('tva')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="form-group mb-3 col-6">
        <label for="amount_ht" class="form-label">Montant HT</label>
        <input type="text" class="form-control" id="amount_ht" name="amount_ht" readonly placeholder="Montant HT" />
    </div>
    <div class="form-group mb-3 col-6">
        <label for="amount_tvac" class="form-label">Montant TTC</label>
        <input type="text" class="form-control" id="amount_tvac" name="amount_tvac" readonly placeholder="Montant TTC" />
    </div>
</div>

<div class="row">
    <div class="form-group mb-3 col-12">
        <label for="proforma_invoice_date" class="form-label">
            <i class="bi bi-calendar"></i> Date de facturation
        </label>
        <input type="date" class="form-control @error('proforma_invoice_date') is-invalid @enderror" id="proforma_invoice_date" name="proforma_invoice_date" value="{{ old('proforma_invoice_date', $proforma_invoice->proforma_invoice_date ?? '') }}" placeholder="Date de facturation" />
        @error('proforma_invoice_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
