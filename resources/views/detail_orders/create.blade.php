<!-- resources/views/detail_orders/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajouter un article ou un service à la commande #{{ $order->id }}</h3>

    <form action="{{ route('orders.detail-orders.store', $order) }}" method="POST" id="orderForm">
        @csrf
        @include('detail_orders._form')

        <button type="submit" class="btn btn-primary">Ajouter l'article ou le service</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>

    <br>
    <h3>Liste des articles ou service du commande</h3>
    @php
        $count = 1;
    @endphp

    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Article</th>
                <th>Unité</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total HT en FBu</th>
                <th>TVA en FBu</th>
                <th>Prix total TVAC en Fbu</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($order->detailOrders as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{$detail->unit}}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }} </td>
                <td>{{ $detail->total_price * $order->tva / 100 }}</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $order->tva / 100)), 2) }}</td>

                <td>
                                <a href="" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}">
                                    <i class="bi bi-trash"></i>
                                  </button>
                                      <!-- Composant modal -->
                                    @include('components.delete-confirmation-modal', [
                                        'id'=>  $detail->id,
                                        'route'=> 'detail-orders.destroy',
                                        'title' => 'Confirmation de suppression',
                                        'message' => 'Êtes-vous sûr de vouloir supprimer ce produit ',
                                        'confirmText' => 'Supprimer'
                                    ])
                            </td>
                </td>

            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>{{ number_format($order->amount, 2) }} Fr Bu</th>
                <th></th>
            </tr>
        </tfoot> --}}
    </table>

    <h3>Liste des articles ou service du de la facture proforma</h3>
    @php
        $count = 1;
    @endphp
    <form action=" {{ route('addselect')}}" method="post">
             @csrf

    <input type="hidden" name="order_id" value="{{ $order->id}}">
    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Article</th>
                 <th>Unité</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total HT en FBu</th>
                <th>TVA en FBu</th>
                <th>Prix total TVAC en Fbu</th>
                <th><button class="btn btn-primary" type="submit">AJOUTER</button></th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->proformaInvoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                  <td>{{ $detail->unit}}</td>
                <td>{{ $detail->quantity }}</td>

                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }} </td>
                <td>{{ $detail->total_price * $order->tva / 100 }}</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $order->tva / 100)), 2) }}</td>
                <td class="text-center">
                    <input type="checkbox" name="select[]" id="" value=" {{ $detail }}">
                </td>

            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>{{ number_format($order->amount, 2) }} Fr Bu</th>
                <th></th>
            </tr>
        </tfoot> --}}
    </table>
    </form>
    <script>
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            // Définir un tableau des ids des champs à vérifier
            const fields = ['tc', 'atax', 'pf'];

            // Parcourir chaque champ pour vérifier s'il est vide
            fields.forEach(function(fieldId) {
                const fieldInput = document.getElementById(fieldId);
                if (fieldInput.value.trim() === '') {
                    fieldInput.value = '0'; // Assigner la valeur par défaut de 0
                }
            });
        });
    </script>

</div>
@endsection
