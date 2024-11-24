<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la commande')
@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la commande #{{ $order->id }}
    </h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la commande</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Numéro de commande</dt>
                <dd class="col-sm-9">{{ $order->id }}</dd>

                <dt class="col-sm-3">Client</dt>
                <dd class="col-sm-9">{{ $order->client->name ?? ''}}</dd>

                <dt class="col-sm-3">Entreprise</dt>
                <dd class="col-sm-9">{{ $order->entreprise->name ?? 'Non spécifié' }}</dd>

               {{-- <dt class="col-sm-3">Désignation</dt>
                <dd class="col-sm-9">{{ $order->designation ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Quantité</dt>
                <dd class="col-sm-9">{{ $order->quantity ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Prix Unitaire</dt>
                <dd class="col-sm-9">{{ number_format($order->amount, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant HT</dt>
                <dd class="col-sm-9">{{ number_format($order->amount *$order->quantity, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant TVAC</dt>
                <dd class="col-sm-9">{{ number_format($order->amount_tvac, 2, ',', ' ') }} BIF</dd>

                  --}}
                   <dt class="col-sm-3">Prix total HTVA </dt>
                             <dd class="col-sm-9">{{ number_format($order->detailOrders->sum('total_price'), 2) }} Fbu</dd>
                             <dt class="col-sm-3">TVA </dt>
                             <dd class="col-sm-9">{{ $order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * $invoice->order->tva / 100, 0):'' }} Fbu</dd>
                             <dt class="col-sm-3">Prix total TVAC </dt>
                             <dd class="col-sm-9">{{ $order->entreprise->assujeti?number_format($invoice->order->detailOrders->sum('total_price') * (1 + $invoice->order->tva / 100), 0):'' }} Fbu</dd>
                             <dt class="col-sm-3">Prix en Lettre</dt>
                             <dd class="col-sm-9">Nous disons {{ $order->price_letter}}</dd>

                <dt class="col-sm-3">Date de commande</dt>
                <dd class="col-sm-9">{{ $order->order_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Date de livraison</dt>
                <dd class="col-sm-9">{{ $order->delivery_date->format('d/m/Y') }}</dd>
                <dt class="col-sm-3">La livraison a été  Terminée ?</dt>
                @if($order->status_livraison==1)
                     <dd class="col-sm-9" style="color:blue;">OUI</dd>
                     @else
                     <dd class="col-sm-9" style="color:red;">Non</dd>
                @endif
                <dt class="col-sm-3">Statut de la commande</dt>
                <dd class="col-sm-9">
                    <span class="">
                        {{ $order->status }}
                    </span>
                </dd>

                <dt class="col-sm-3">Créé par</dt>
                <dd class="col-sm-9">{{ $order->user->name ?? 'z' }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $order->description ?? 'Aucune description' }}</dd>
            </dl>
                   <div class="mt-4">
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier la commande
        </a>
                   </div>
        </div>
    </div>
</div>
<br>
    @php
        $count = 1;
    @endphp
      <div class="card shadow mb-4 ">
        <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Article</th>
                   <th>Unité</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total HT</th>
                <th>TVA</th>
                <th>Prix total TVAC</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->detailOrders as $detail)
            <tr>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $count}}</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $detail->product_name ?? '' }}</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $detail->unit ?? ''}}</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $detail->quantity ??''}}</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ number_format($detail->unit_price, 2) ??'' }} Fr Bu</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ number_format($detail->total_price, 2) ?? '' }} Fr Bu</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ $detail->total_price * $order->tva / 100 }} Fr Bu</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">{{ number_format( ($detail->total_price + ($detail->total_price * $order->tva / 100)), 2) }} FBu</td>
                <td style="max-width: 150px;word-wrap: break-word;  vertical-align: top; ">
                    <a href="{{ route('orders.detail-orders.edit', [$order, $detail]) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>



            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}">
                <i class="bi bi-trash"></i>
            </button>
            <div class="modal fade" id="deleteConfirmationModal{{ $detail->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $detail->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $detail->id }}">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Confirmation de suppression
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </button>
                            <form action="{{ route( 'orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" style="display: inline-block;" class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" >
                                    <i class="bi bi-trash me-2"></i> Supprimer
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


                </td>
            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
        {{-- <tfoot>
            <tr>
                <th colspan="4">Total en Fbu</th>
                <th>{{ number_format($order->amount, 2) }}</th>
                <th></th>
            </tr>
        </tfoot> --}}
    </table>


       </div>
          </div>
    <div class="row">

    </div>
    <div class="card shadow mb-4 ">
        <div class="card-body">
                <div class="card-body">
    <h6 class="m-0 font-weight-bold text-primary">Ecrivez le prix en Lettre </h6>
     <div class="row">
        <p></p>
     </div>
     <form action="{{ route('addPriceLetterOrder', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
      <div class="row">
                   <div class="form-group mb-3  col-8">
             <input type="text" class="form-control @error('price_letter') is-invalid @enderror" id="price_letter" name="price_letter" value="{{ old('price_letter', $proforma_invoice->price_letter ?? '') }}" required>
            @error('price_letter')
         <div class="invalid-feedback">{{ $message }}</div>
          @enderror
           </div>
            <div class="form-group mb-3  col-4">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Ajouter à la commande
                    </button>
                    <a href="{{ route('order_alllist')}}"  class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
        </div>
        </form>
    </div>
    </div>
      </div>
    </div>
    <div class="container">
     <div class="card shadow mb-4 ">
        <div class="card-body">
    <div class="row">

       <div class="mt-4">
    <a href="{{  route('order_alllist') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des commandes
        </a>

        <a href="{{ route('orders.detail-orders.create', $order) }}" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i>
        Ajouter un article ou service</a>
        <a href="{{ route('order_alllist')}}" class="btn btn-primary">
        <i class="bi bi-eye"></i> Visualiser des commandes </a>
         <a href="{{ route('invoices.create', $order) }}" class="btn btn-primary">
             <i class="bi bi-plus-circle"></i>
            Ajouter la facture
        </a>
              <a href="{{ route('invoices.index', $order) }}" class="btn btn-primary">
              <i class="bi bi-eye"></i>
            Visualiser les factures
        </a>
    </div>
    </div>
      </div>
        </div>
         </div>
</div>
@endsection
