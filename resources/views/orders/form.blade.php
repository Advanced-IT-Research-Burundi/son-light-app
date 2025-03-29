<div class="form-group mb-3">
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="proforma_invoice_search" class="form-label">Rechercher une facture proforma</label>
            <input type="text" class="form-control" id="proforma_invoice_search" placeholder="Tapez pour rechercher...">
        </div>
        <div class="form-group mb-3 col-6">
            <label for="proforma_invoice_id" class="form-label">Facture proforma</label>
            <select class="form-select @error('proforma_invoice_id') is-invalid @enderror" id="proforma_invoice_id" name="proforma_invoice_id" required>
                <option value="">Sélectionnez une facture proforma</option>
                @foreach($proforma_invoices as $proforma_invoice)
                    <option value="{{ $proforma_invoice->id }}"
                            {{ old('proforma_invoice_id', $order->proforma_invoice_id ?? '') == $proforma_invoice->id ? 'selected' : '' }}
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
    </div>
    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="client_id" class="form-label"><i class="bi bi-person"></i> Client</label>
            <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                <option value="">Sélectionnez un client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $order->client_id ?? '') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="company_id" class="form-label"><i class="bi bi-people-fill"></i> Entreprise</label>
            <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                <option value="">Sélectionnez une entreprise</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $order->company_id ?? '') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
            @error('company_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-6">
            <label for="designation" class="form-label"><i class="bi bi-calendar"></i> Désignation</label>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $order->designation ?? '') }}" required>
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3 col-6">
            <label for="amount" class="form-label"><i class="bi bi-cash-coin"></i> P.U</label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $order->amount ?? '0') }}" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-6">
            <label for="quantity" class="form-label"><i class="bi bi-list-nested"></i> Quantité</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity ?? '') }}" required data-calc="quantity">
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
            <input type="number" class="form-control @error('tc') is-invalid @enderror" id="tc" name="tc" value="{{ old('tc', $order->tc ?? '') }}" required placeholder="0">
            @error('tc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-6">
            <label for="atax" class="form-label"><i class="bi bi-cash-coin"></i> A.TAX || Uniquement pour SLPS</label>
            <input type="number" class="form-control @error('atax') is-invalid @enderror" id="atax" name="atax" value="{{ old('atax', $order->atax ?? '') }}" required placeholder="0">
            @error('atax')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-6">
            <label for="pf" class="form-label">PF || Uniquement pour SLPS</label>
            <input type="number" class="form-control @error('pf') is-invalid @enderror" id="pf" name="pf" value="{{ old('pf', $order->pf ?? '') }}" required placeholder="0">
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
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const proformaInvoiceSearch = document.getElementById('proforma_invoice_search');
    const proformaInvoiceSelect = document.getElementById('proforma_invoice_id');

    proformaInvoiceSearch.addEventListener('input', function() {
        const searchTerm = proformaInvoiceSearch.value.toLowerCase();
        const options = proformaInvoiceSelect.options;

        for (let i = 1; i < options.length; i++) {
            const option = options[i];
            const optionText = option.textContent.toLowerCase();

            if (optionText.includes(searchTerm)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
    });

    proformaInvoiceSelect.addEventListener('change', function() {
        const selectedOption = proformaInvoiceSelect.options[proformaInvoiceSelect.selectedIndex];


        document.getElementById('client_id').value = selectedOption.getAttribute('data-client-id');
        document.getElementById('company_id').value = selectedOption.getAttribute('data-company-id');
        document.getElementById('amount').value = selectedOption.getAttribute('data-amount');
        document.getElementById('designation').value = selectedOption.getAttribute('data-designation');
        document.getElementById('quantity').value = selectedOption.getAttribute('data-quantity');
        document.getElementById('tva').value = selectedOption.getAttribute('data-tva');


        calculateAmounts();
    });

    function calculateAmounts() {
        const price = parseFloat(document.getElementById('amount').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        const tvaRate = parseFloat(document.getElementById('tva').value) || 0;

        const totalHt = price * quantity;
        const totalTvac = totalHt * (1 + tvaRate / 100);

        document.getElementById('amount_ht').value = totalHt.toFixed(2);
        document.getElementById('amount_tvac').value = totalTvac.toFixed(2);
    }


    [document.getElementById('amount'), document.getElementById('quantity'), document.getElementById('tva')].forEach(element => {
        element.addEventListener('input', calculateAmounts);
    });

    calculateAmounts();
});
</script>
@stop
