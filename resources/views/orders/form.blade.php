<div class="form-group mb-3">
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="proforma_invoice_id" class="form-label">
                Facture proforma
            </label>
            <select class="form-select @error('proforma_invoice_id') is-invalid @enderror" id="proforma_invoice_id" name="proforma_invoice_id" required>
                <option value="">Sélectionnez une facture proforma</option>
                @foreach($proforma_invoices as $proforma_invoice)
                    <option value="{{$proforma_invoice->id }}" {{ old('proforma_invoice_id', $order->proforma_invoice_id ?? '') == $proforma_invoice->id ? 'selected' : '' }} data-client-id="{{ $proforma_invoice->client_id }}" data-company-id="{{ $proforma_invoice->company_id }}" data-amount="{{ $proforma_invoice->amount }}" data-designation="{{ $proforma_invoice->designation }}" data-tva="{{ $proforma_invoice->tva }}">
                        {{ $proforma_invoice->id }} - {{ $proforma_invoice->invoice_number }} - {{ $proforma_invoice->entreprise->name }} - {{ $proforma_invoice->designation }}
                    </option>
                @endforeach
            </select>
            @error('proforma_invoice_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-6">
            <label for="order_date" class="form-label">
                <i class="bi bi-calendar"></i> Date de la commande
            </label>
            <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date ?? '') }}" required>
            @error('order_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="client_id" class="form-label">
                <i class="bi bi-person"></i> Client
            </label>
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

        <div class="form-group mb-3 col-6">
            <label for="company_id" class="form-label">
                <i class="bi bi-people-fill"></i> Entreprise
            </label>
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
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="designation" class="form-label">
                <i class="bi bi-calendar"></i> Désignation
            </label>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $order->designation ?? '') }}" required>
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-6">
            <label for="unit" class="form-label">Unité</label>
            <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit',  $order->unit ?? '') }}">
            @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Amount and TVA Calculation Section -->
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="amount" class="form-label"><i class="bi bi-cash-coin"></i> P.U</label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount',  $order->amount ?? '0') }}" required data-calc="price">
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3 col-6">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity',  $order->quantity ?? '0') }}" required data-calc="quantity">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Calculate Montant HT and TVA -->
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="amount_ht" class="form-label">Montant HT</label>
            <input type="text"  class="form-control" id="amount_ht" name="amount_ht" readonly>
        </div>

        <div class="form-group mb-3 col-6">
            <label for="amount_tvac" class="form-label">Montant TTC</label>
            <input type="text"  class="form-control" id="amount_tvac" name="amount_tvac" readonly>
        </div>
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
    const tvaSelect = document.getElementById('tva');

    // When the proforma invoice is selected, fill the other fields
    proformaInvoiceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const clientId = selectedOption.getAttribute('data-client-id');
        const companyId = selectedOption.getAttribute('data-company-id');
        const amount = selectedOption.getAttribute('data-amount');
        const designation = selectedOption.getAttribute('data-designation');
        const tva = selectedOption.getAttribute('data-tva');

        // Fill the client, company, and other fields
        clientSelect.value = clientId;
        companySelect.value = companyId;
        amountInput.value = amount;
        designationInput.value = designation;
        tvaSelect.value = tva;

        // Optionally, you can trigger recalculation here if needed
        calculateAmounts();
    });

    // Function to calculate Montant HT and Montant TTC
    function calculateAmounts() {
        const price = parseFloat(amountInput.value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        const tvaRate = parseFloat(tvaSelect.value) || 0;

        const totalHt = price * quantity;
        const totalTvac = totalHt * (1 + tvaRate / 100);

        document.getElementById('amount_ht').value = totalHt.toFixed(2);
        document.getElementById('amount_tvac').value = totalTvac.toFixed(2);
    }

    // Recalculate when price, quantity or tva change
    [amountInput, document.getElementById('quantity'), tvaSelect].forEach(element => {
        element.addEventListener('input', calculateAmounts);
    });

    // Initial calculation in case of default values
    calculateAmounts();
});
</script>
@stop
