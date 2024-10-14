<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la facture proforma')
@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la facture proforma #{{ $proforma_invoice->id }}
    </h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la facture proforma</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Numéro de la facture proforma</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->id }}</dd>

                <dt class="col-sm-3">Client</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->client->name }}</dd>

                <dt class="col-sm-3">Entreprise</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->entreprise->name ?? 'Non spécifié' }}</dd>

                {{-- <dt class="col-sm-3">Désignation</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->designation ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Quantité</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->quantity ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Prix Unitaire</dt>
                <dd class="col-sm-9">{{ number_format($proforma_invoice->amount, 2, ',', ' ') }} BIF</dd> --}}

                <dt class="col-sm-3">Montant HT</dt>
                <dd class="col-sm-9">{{ number_format($proforma_invoice->amount_ht, 2, ',', ' ') }} BIF</dd>

                <dt class="col-sm-3">Montant TVAC</dt>
                <dd class="col-sm-9">{{ number_format($proforma_invoice->amount_tvac, 2, ',', ' ') }} BIF</dd>


                <dt class="col-sm-3">Date de facturation</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->proforma_invoice_date }}</dd>
               

                <dt class="col-sm-3">Créé par</dt>
                <dd class="col-sm-9">{{ $proforma_invoice->user->name }}</dd>

            </dl>
        </div>
    </div>

    <div class="mt-4">
       <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste des factures
        </a>
        <a href="{{ route('proforma_invoices.edit', $proforma_invoice->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier la proforma
        </a>
        <a href="{{ route('proforma_invoices.proforma_invoice_lists.create', $proforma_invoice) }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>  Ajouter un article ou un service
        </a>
        <a href="{{ route('proforma_invoices.orders.create', $proforma_invoice) }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Créer la facture proforma(la commande)</a>
      
        <a href="{{ route('proforma_invoices.generatePDF', $proforma_invoice) }}" class="btn btn-success">Générer PDF</a>
             <a href="" class="btn btn-primary">
             <i class="bi bi-plus-circle"></i> Créer la facture(simple) </a>
    </div>



</div>

<div class="container">
   
    <!-- ... autres détails de la commande ... -->
     <div class="row">
        <p><br></p>
     </div>
    @php
        $count = 1;
    @endphp
    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total HT</th>
                <th>TVA</th>
                <th>Prix total TVAC</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }} Fr Bu</td>
                <td>{{ number_format($detail->total_price, 2) }} Fr Bu</td>
                <td>{{ $detail->total_price * $proforma_invoice->tva / 100 }} Fr Bu</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $proforma_invoice->tva / 100)), 2) }} Fr Bu</td>
                <td>
                    <a href="{{ route('proforma_invoices.proforma_invoice_lists.edit', [$proforma_invoice, $detail]) }}" class="btn btn-sm btn-info">Modifier</a>
                    <form action="{{ route('proforma_invoices.proforma_invoice_lists.destroy', [$proforma_invoice, $detail]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ou service ?')">Supprimer</button>
                    </form>
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
                <th>{{ number_format($proforma_invoice->amount, 2) }} Fr Bu</th>
                <th></th>
            </tr>
        </tfoot> --}}
    </table>
</div>
@endsection
