<div class="form-group mb-3">
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="proforma_invoice_id" class="form-label">Facture pro forma</label>
            <select class="form-select @error('proforma_invoice_id') is-invalid @enderror" id="proforma_invoice_id" name="proforma_invoice_id" required>
                <option value="">Sélectionnez une facture proforma</option>
                @foreach($proforma_invoices as $proforma_invoice)
                    <option value="{{ $proforma_invoice->id }}" {{ old('proforma_invoice_id', $order->proforma_invoice_id ?? '') == $proforma_invoice->id ? 'selected' : '' }}
                            data-client-id="{{ $proforma_invoice->client_id }}"
                            data-company-id="{{ $proforma_invoice->company_id }}"
                            data-amount="{{ $proforma_invoice->amount }}"
                            data-designation="{{ $proforma_invoice->designation }}"
                            data-tva="{{ $proforma_invoice->tva }}"
                            data-quantity="{{ $proforma_invoice->quantity }}">
                       Facture Numéro {{ $proforma_invoice->id }} du  {{ $proforma_invoice->client->name }} créée le {{ $proforma_invoice->created_at }}  pour {{ $proforma_invoice->designation }}
                    </option>
                @endforeach
            </select>
            @error('proforma_invoice_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="client_id" class="form-label"><i class="bi bi-person"></i> Client</label>
            <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                <option value="">Sélectionnez un client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $order->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client?->name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="company_id" class="form-label"><i class="bi bi-people-fill"></i> Entreprise</label>
            <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                <option value="">Sélectionnez une entreprise</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $order->company_id ?? '') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="designation" class="form-label"><i class="bi bi-calendar"></i> Désignation</label>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $order->designation ?? '') }}" required>
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">

        <div class="mb-3 col-6">
            <label for="unit" class="form-label"><i class="bi bi-box"></i> Unité</label>
            <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $order?->unit ?? $proforma_invoice->unit ?? '') }}">
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="amount" class="form-label"><i class="bi bi-cash-coin"></i> P.U</label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount',  $order->amount ?? '0') }}" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">


        <div class="mb-3 col-6">
            <label for="quantity" class="form-label"><i class="bi bi-list-nested"></i> Quantité</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $order?->quantity ?? $proforma_invoice->quantity ?? '') }}" required data-calc="quantity">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="tva" class="form-label"><i class="bi bi-percent"></i> TVA</label>
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
        <div class="mb-3 col-6">
            <label for="tc" class="form-label"><i class="bi bi-cash-coin"></i> TC || Uniquement pour SLPS</label>
            <input type="number" class="form-control @error('tc') is-invalid @enderror" id="tc" name="tc" value="{{ old('tc', $order?->tc ?? '') }}" required placeholder="0">
            @error('tc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="atax" class="form-label"><i class="bi bi-cash-coin"></i> A.TAX || Uniquement pour SLPS</label>
            <input type="number" class="form-control @error('atax') is-invalid @enderror" id="atax" name="atax" value="{{ old('atax', $order?->atax ?? '') }}" required placeholder="0">
            @error('atax')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">

        <div class="mb-3 col-6">
            <label for="pf" class="form-label">PF || Uniquement pour SLPS</label>
            <input type="number" class="form-control @error('pf') is-invalid @enderror" id="pf" name="pf" value="{{ old('pf', $order?->pf ?? '') }}" required placeholder="0">
            @error('pf')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
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

    <div class="row mt-3">
        <div class="mb-3 col-6">
            <label for="delivery_date" class="form-label"><i class="bi bi-calendar"></i> Date de livraison</label>
            <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', now()->format('Y-m-d')) }}" required>
            @error('delivery_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="order_date" class="form-label"><i class="bi bi-calendar"></i> Date de la commande</label>
            <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date', now()->format('Y-m-d')) }}" required>
            @error('order_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-3">
            <label class="form-label"><i class="bi bi-check2-circle"></i> Statut de la livraison</label>
            <div class="form-check">
                <input class="form-check-input @error('status_livraison') is-invalid @enderror" type="radio" id="status_livraison_yes" name="status_livraison" value="1" {{ old('status_livraison', $order->status_livraison ?? false) ? 'checked' : '' }} required>
                <label class="form-check-label" for="status_livraison_yes">Oui</label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('status_livraison') is-invalid @enderror" type="radio" id="status_livraison_no" name="status_livraison" value="0" {{ old('status_livraison', $order->status_livraison ?? false) ? '' : 'checked' }}>
                <label class="form-check-label" for="status_livraison_no">Non</label>
            </div>
            @error('status_livraison')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
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
    const proformaInvoiceSelect = document.getElementById('proforma_invoice_id');
    const clientSelect = document.getElementById('client_id');
    const companySelect = document.getElementById('company_id');
    const designationInput = document.getElementById('designation');
    const amountInput = document.getElementById('amount');
    const unitInput = document.getElementById('unit');
    const quantityInput = document.getElementById('quantity');
    const tvaSelect = document.getElementById('tva');

    proformaInvoiceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const clientId = selectedOption.getAttribute('data-client-id');
        const companyId = selectedOption.getAttribute('data-company-id');
        const amount = selectedOption.getAttribute('data-amount');
        const designation = selectedOption.getAttribute('data-designation');
        const tva = selectedOption.getAttribute('data-tva');
        const quantity = selectedOption.getAttribute('data-quantity');

        clientSelect.value = clientId;
        companySelect.value = companyId;
        amountInput.value = amount;
        designationInput.value = designation;
        quantityInput.value = quantity;

        if (tva) {
            tvaSelect.value = tva;
        }

        calculateAmounts();
    });

    function calculateAmounts() {
        const price = parseFloat(amountInput.value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        const tvaRate = parseFloat(tvaSelect.value) || 0;

        const totalHt = price * quantity;
        const totalTvac = totalHt * (1 + tvaRate / 100);

        document.getElementById('amount_ht').value = totalHt.toFixed(2);
        document.getElementById('amount_tvac').value = totalTvac.toFixed(2);
    }

    [amountInput, document.getElementById('quantity'), tvaSelect].forEach(element => {
        element.addEventListener('input', calculateAmounts);
    });


    calculateAmounts();
});
</script>
@stop
