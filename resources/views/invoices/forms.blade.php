<div class="row">
    <div class="form-group mb-3 col-6">
        <label for="proforma_invoice_search" class="form-label">Rechercher une commande</label>
        <input type="text" class="form-control" id="commande_search" placeholder="Tapez pour rechercher...">
    </div>
    <div class="form-group mb-3 col-6">
        <label for="order_id" class="form-label">Commande</label>
        <select class="form-select @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
            <option value="">Sélectionnez une commande</option>
            @foreach($orders as $order)
                <option value="{{ $order->id }}"
                        {{ old('order_id', $order->order_id ?? '') == $order->id ? 'selected' : '' }}
                        data-client-id="{{ $order->client_id }}"
                        data-company-id="{{ $order->company_id }}"
                        data-amount="{{ $order->amount }}"
                        data-designation="{{ $order->designation }}"
                        data-unit="{{ $order->unit }}"
                        data-tva="{{ $order->tva }}"
                        data-quantity="{{ $order->quantity }}">
                   Facture Numéro {{ $order->id }} du  {{ $order->client->name }} créée le {{ $order->created_at }}  pour {{ $order->designation }}
                </option>
            @endforeach
        </select>
        @error('proforma_invoice_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <div class="form-group col-md-6">
        <label for="number" class="form-label">Numéro de facture</label>
        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $number) }}">
        @error('number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="id_true_invoice" class="form-label">ID de la facture client <small>(Uniquement pour Son Light Paper Services)</small></label>
        <input type="text" class="form-control @error('id_true_invoice') is-invalid @enderror" id="id_true_invoice" name="id_true_invoice" value="{{ old('id_true_invoice') }}" placeholder="4000652612/N860W672409/144707/N860W672409/FN66/2024">
        @error('id_true_invoice')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-4">
    <div class="form-group col-md-6">
        <label for="date" class="form-label">Date de la facture</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="due_date" class="form-label">Date d'échéance</label>
        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}">
        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // On récupère le champ de recherche et le select
        const searchInput = document.getElementById('commande_search');
        const orderSelect = document.getElementById('order_id');

        // Écouteur d'événement sur le champ de recherche
        searchInput.addEventListener('input', function () {
            const searchValue = searchInput.value.toLowerCase();  // Valeur de recherche en minuscule

            // On parcourt toutes les options du select
            const options = orderSelect.querySelectorAll('option');
            options.forEach(function (option) {
                // Si la valeur du champ recherche est dans l'option, on l'affiche
                const optionText = option.textContent.toLowerCase();
                if (optionText.includes(searchValue)) {
                    option.style.display = ''; // Afficher l'option
                } else {
                    option.style.display = 'none'; // Masquer l'option
                }
            });
        });
    });
</script>
