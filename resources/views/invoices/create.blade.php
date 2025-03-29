@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary mb-4">
                <i class="bi bi-plus-circle"></i> Créer une facture client
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group mb-3 col-6">
                        <label for="commande_search" class="form-label">Rechercher une commande</label>
                        <input type="text" class="form-control" id="commande_search" placeholder="Tapez pour rechercher...">
                    </div>
                    <div class="form-group mb-3 col-6">
                        <label for="order_id" class="form-label">Commande</label>
                        <select class="form-select @error('order_id') is-invalid @enderror" id="order_id" name="order_id" required>
                            <option value="">Sélectionnez une commande</option>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}"
                                        {{ old('order_id') == $order->id ? 'selected' : '' }}
                                        data-client-id="{{ $order->client_id }}"
                                        data-company-id="{{ $order->company_id }}"
                                        data-amount="{{ $order->amount }}"
                                        data-designation="{{ $order->designation }}"
                                        data-unit="{{ $order->unit }}"
                                        data-tva="{{ $order->tva }}"
                                        data-quantity="{{ $order->quantity }}"
                                        data-details="{{ json_encode($order->detailOrders) }}">
                                   Facture Numéro {{ $order->id }} du {{ $order->client->name }} créée le {{ $order->created_at }} pour {{ $order->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('order_id')
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

                <div class="mb-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Créer la facture</button>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary"><i class="bi bi-x-lg"></i> Annuler</a>
                </div>
            </form>
        </div>

        <div class="card-footer">
            <h4 class="mt-5"><i class="bi bi-file-earmark-text"></i> Détails de la facture</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Ordre</th>
                            <th>Article</th>
                            <th>Qté</th>
                            <th>P.U (FBU)</th>
                            <th>PV-HTA (FBU)</th>
                            <th>TVA (FBU)</th>
                            <th>TVAC (FBU)</th>
                            <th>PVT (FBU)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="detailOrderTable">
                        <!-- Les détails de la commande sélectionnée s'afficheront ici -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><strong>TOTAUX</strong></td>
                            <td><strong id="totalPrice">0</strong></td>
                            <td><strong id="totalTva">0</strong></td>
                            <td><strong id="totalTvac">0</strong></td>
                            <td><strong id="totalPvt">0</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderSelect = document.getElementById('order_id');
        const tableBody = document.getElementById('detailOrderTable');
        const searchInput = document.getElementById('commande_search');

        function updateTable(orderDetails, tva, assujeti) {
            tableBody.innerHTML = '';  // Vider le tableau à chaque fois

            let count = 1;
            let totalPrice = 0;
            let totalTva = 0;
            let totalTvac = 0;
            let totalPvt = 0;

            orderDetails.forEach(detail => {
                const row = document.createElement('tr');

                const unitPrice = detail.unit_price || 0;
                const totalPriceDetail = detail.total_price || 0;
                const tvaValue = assujeti ? (totalPriceDetail * tva / 100) : 0;
                const tvac = assujeti ? (totalPriceDetail * (1 + tva / 100)) : 0;
                const pvt = detail.pf + detail.tc + detail.atax + (assujeti ? tvac : 0);

                row.innerHTML = `
                    <td>${count}</td>
                    <td>${detail.product_name}</td>
                    <td>${detail.quantity}</td>
                    <td>${numberWithCommas(unitPrice.toFixed(0))}</td>
                    <td>${numberWithCommas(totalPriceDetail.toFixed(0))}</td>
                    <td>${numberWithCommas(tvaValue.toFixed(0))}</td>
                    <td>${numberWithCommas(tvac.toFixed(0))}</td>
                    <td>${numberWithCommas(pvt.toFixed(0))}</td>
                    <td><!-- Actions --></td>
                `;

                tableBody.appendChild(row);

                totalPrice += totalPriceDetail;
                totalTva += tvaValue;
                totalTvac += tvac;
                totalPvt += pvt;

                count++;
            });

            document.getElementById('totalPrice').textContent = numberWithCommas(totalPrice.toFixed(0));
            document.getElementById('totalTva').textContent = numberWithCommas(totalTva.toFixed(0));
            document.getElementById('totalTvac').textContent = numberWithCommas(totalTvac.toFixed(0));
            document.getElementById('totalPvt').textContent = numberWithCommas(totalPvt.toFixed(0));
        }

        function numberWithCommas(x) {
            return x.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
        }

        function fillTableWithSelectedOrder() {
            const selectedOption = orderSelect.options[orderSelect.selectedIndex];
            if (selectedOption.value) {
                const orderDetails = JSON.parse(selectedOption.getAttribute('data-details'));
                const tva = parseFloat(selectedOption.getAttribute('data-tva'));
                const assujeti = selectedOption.dataset.clientId === '1';
                updateTable(orderDetails, tva, assujeti);
            } else {
                tableBody.innerHTML = ''; // Vider le tableau si aucune commande sélectionnée
            }
        }

        orderSelect.addEventListener('change', fillTableWithSelectedOrder);

        searchInput.addEventListener('input', function () {
            const searchValue = searchInput.value.toLowerCase();
            const options = orderSelect.querySelectorAll('option');
            options.forEach(function (option) {
                const optionText = option.textContent.toLowerCase();
                if (optionText.includes(searchValue)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
