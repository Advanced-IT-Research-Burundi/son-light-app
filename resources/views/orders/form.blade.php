<div class="form-group mb-3">
    <div class="row">
    <div class="form-group mb-3 col-6">
    <label for="client_id" class="form-label">
        Facture proforma
    </label>
    <select class="form-select @error('proforma_invoice_id') is-invalid @enderror" id="proforma_invoice_id" name="proforma_invoice_id" required>
        <option value="">Sélectionnez une facture proforma</option>
        @foreach($proforma_invoices as $proforma_invoice)
            <option value="{{$proforma_invoice->id }}" {{ old('proforma_invoice_id', $order->proforma_invoice_id ?? '') == $proforma_invoice->id ? 'selected' : '' }}>
                 {{ $proforma_invoice->id }} - {{ $proforma_invoice->invoice_number }} - {{ $proforma_invoice->entreprise->name }} -    {{ $proforma_invoice->id }} - {{ $proforma_invoice->invoice_number }} - {{ $proforma_invoice->designation }}
            </option>
        @endforeach
    </select>
    @error('proforma_invoice_id')
        <div class="invalid-feedback">{{$message }}</div>
    @enderror
</div>
 <div class="form-group mb-3  col-6">
     <label for="delivery_date" class="form-label">
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
                {{ $client->name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
  <div class="form-group mb-3  col-6">
    <label for="company_id" class="form-label">
    <i class="bi bi-people-fill"></i> 
        Entreprise</label>
    <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
        <option value="">Sélectionnez une entreprise</option>
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
  <div class="form-group mb-3  col-6">
    <label for="order_date" class="form-label">
        <i class="bi bi-calendar"></i> Désignation
    </label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $order->designation ?? '') }}" required>
    @error('designation')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
        <div class="mb-3 col-6">
    <label for="unit" class="form-label">Unité</label>
    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit',  $order->unit??'') }}" >
    @error('unit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
    </div>
    <div class="row">
      <div class="form-group mb-3 col-6">
    <label for="amount" class="form-label"><i class="bi bi-cash-coin"></i> P.U</label>
        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount',  $order->amount??'0') }}" required data-calc="price">
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mb-3 col-6">
        <label for="quantity" class="form-label">
            Quantité
        </label>
        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity',  $order->quantity??'0') }}" required data-calc="quantity">
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    </div>

    <div class="row">
      <div class="form-group mb-3 col-6">
        <label for="amount_ht" class="form-label">
            Montant HT
        </label>
        <input type="text"  class="form-control" id="amount_ht" name="amount_ht" readonly>
    </div>
    <div class="form-group mb-3 col-6">
        <label for="amount_tvac" class="form-label">
            Montant TTC
        </label>
        <input type="text"  class="form-control" id="amount_tvac" name="amount_tvac" readonly>
    </div>
    </div>
</div>
<div class="row">
     <div class="form-group mb-3 col-6">
        <label for="tva" class="form-label">
            TVA
        </label>
        <select class="form-select @error('tva') is-invalid @enderror" id="tva" name="tva" required data-calc="tva">
            <option value="">Sélectionnez un taux</option>
            @foreach(TVA_RANGE as $rate)
                <option value="{{ $rate }}" {{ old('tva', $order->tva ?? '') == $rate ? 'selected' : '' }}>
                    {{ $rate }}%
                </option>
            @endforeach
        </select>
        @error('tva')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
<div class="form-group mb-3 col-6">
    <label for="delivery_date" class="form-label">
        <i class="bi bi-calendar"></i> Date de livraison
    </label>
    <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $order->delivery_date ?? '') }}" required>
    @error('delivery_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

</div>

<div class="row mt-3">
<div class="form-group mb-3 col-6">
    <label for="status" class="form-label">
        <i class="bi bi-check2-circle"></i> Statut de la livraison
    </label>
          <select class="form-select @error('status_livraison') is-invalid @enderror" id="status_livraison" name="status_livraison" required>
        <option value="">Sélectionnez un statut correspondant</option>
        <option value="2" {{ old('status_livraison', $order->status_livraison ?? '') == 2 ? 'selected' : '' }}>En attente</option>
        <option value="1" {{ old('status_livraison', $order->status_livraison ?? '') == 1 ? 'selected' : '' }}>Immediatement</option>
         <option value="1" {{ old('status_livraison', $order->status_livraison ?? '') == 1 ? 'selected' : '' }}>Terminée</option>
    </select>
        @error('status_livraison')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-6">
    <label for="status" class="form-label">
        <i class="bi bi-check2-circle"></i> Statut de la commande
    </label>
    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="">Sélectionnez un statut correspondant</option>
        <option value="En attente" {{ old('status', $order->status ?? '') == 'En attente' ? 'selected' : '' }}>En attente</option>
        <option value="En cours" {{ old('status', $order->status ?? '') == 'En cours' ? 'selected' : '' }}>En cours</option>
        <option value="Terminée" {{ old('status', $order->status ?? '') == 'Terminée' ? 'selected' : '' }}>Terminée</option>
        <option value="Annulée" {{ old('status', $order->status ?? '') == 'Annulée' ? 'selected' : '' }}>Annulée</option>
    </select>
    {{-- <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="">Sélectionnez un statut</option>
        <option value="pending" {{ old('status', $order->status ?? '') == 'pending' ? 'selected' : '' }}>En attente</option>
        <option value="processing" {{ old('status', $order->status ?? '') == 'processing' ? 'selected' : '' }}>En cours</option>
        <option value="completed" {{ old('status', $order->status ?? '') == 'completed' ? 'selected' : '' }}>Terminée</option>
        <option value="cancelled" {{ old('status', $order->status ?? '') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
    </select> --}}
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