@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Ajouter un Article ou un Service à la Commande #{{ $order->id }}</h3>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Utiliser la Méthode Manuelle</h5>
        </div>
        <div class="card-body">
            <p>Pour ajouter manuellement un article ou un service à cette commande, remplissez tous les champs ci-dessous. Cliquez sur le bouton "Ajouter l'article ou le service" lorsque vous avez terminé.</p>
            <form action="{{ route('orders.detail-orders.store', $order) }}" method="POST" id="orderForm">
                @csrf
                @include('detail_orders._form')

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Ajouter l'Article ou le Service</button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <h5 class="mb-4">Utiliser la Méthode Automatique</h5>
    <p>Cochez les articles et services ci-dessous pour les ajouter directement à la commande depuis la liste des articles de la facture pro forma. Cette méthode vous fera gagner du temps.</p>
    <p class="text-danger">Attention : Ne cochez pas l'article ou service de la première ligne, car cela pourrait engager la duplication des articles ou services.</p>

    <form action="{{ route('addselect') }}" method="post" class="mb-4">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Ordre</th>
                        <th>Article</th>
                        <th>Unité</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire (FBu)</th>
                        <th>Prix Total HT (FBu)</th>
                        <th>TVA (FBu)</th>
                        <th>Prix Total TVAC (FBu)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($order->proformaInvoice->proformaInvoiceList as $detail)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->unit }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price, 2, ',', ' ') }}</td>
                        <td>{{ number_format($detail->total_price, 2, ',', ' ') }}</td>
                        <td>{{ number_format($detail->total_price * $order->tva / 100, 2, ',', ' ') }}</td>
                        <td>{{ number_format(($detail->total_price + ($detail->total_price * $order->tva / 100)), 2, ',', ' ') }}</td>
                        <td class="text-center">
                            <input type="checkbox" name="select[]" value="{{ json_encode($detail) }}"> <!-- envoyer l'objet en JSON -->
                        </td>
                    </tr>
                    @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <button class="btn btn-primary" type="submit">AJOUTER</button>
            </div>
        </div>
    </form>

    <!-- Liste des articles ou services de la commande -->
    <h5 class="my-4">Liste des Articles ou Services de la Commande</h5>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ordre</th>
                    <th>Article</th>
                    <th>Unité</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire (FBu)</th>
                    <th>Prix Total HT (FBu)</th>
                    <th>TVA (FBu)</th>
                    <th>Prix Total TVAC (FBu)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach($order->detailOrders as $detail)
                <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->unit }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price, 2, ',', ' ') }}</td>
                    <td>{{ number_format($detail->total_price, 2, ',', ' ') }}</td>
                    <td>{{ number_format($detail->total_price * $order->tva / 100, 2, ',', ' ') }}</td>
                    <td>{{ number_format(($detail->total_price + ($detail->total_price * $order->tva / 100)), 2, ',', ' ') }}</td>
                    <td>
                        <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-primary" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}" title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                        @include('components.delete-confirmation-modal', [
                            'id'=>  $detail->id,
                            'route'=> 'detail-orders.destroy',
                            'title' => 'Confirmation de Suppression',
                            'message' => 'Êtes-vous sûr de vouloir supprimer ce produit ?',
                            'confirmText' => 'Supprimer'
                        ])
                    </td>
                </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            const fields = ['tc', 'atax', 'pf'];
            fields.forEach(function(fieldId) {
                const fieldInput = document.getElementById(fieldId);
                if (fieldInput && fieldInput.value.trim() === '') {
                    fieldInput.value = '0';
                }
            });
        });
    </script>
</div>
@endsection
