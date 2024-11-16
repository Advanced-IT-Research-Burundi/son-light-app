<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la facture proforma')
@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la facture proforma #{{ $proforma_invoice->id }}
    </h3>
    <div class="card shadow mb-4">
                <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la facture proforma</h6>
        </div>
                    <div class="card-body">
                        <dl class="row">
                             <dt class="col-sm-3">Date de facturation</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->proforma_invoice_date }}</dd>
                              <dt class="col-sm-3">Numéro de la facture proforma</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->id }}</dd>
                              <dt class="col-sm-3">Client</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->client->name }}</dd>
                              <dt class="col-sm-3">Entreprise</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->entreprise->name ?? 'Non spécifié' }}</dd>
                              <dt class="col-sm-3">Désignation</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->designation ?? 'Non spécifié' }}</dd>
                              <dt class="col-sm-3">Unite de mesure</dt>
                              <dd class="col-sm-9">{{ $proforma_invoice->unit }}</dd>
                              <dt class="col-sm-3">Prix total HTVA </dt>
                             <dd class="col-sm-9">{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }} Fbu</dd>
                             <dt class="col-sm-3">TVA </dt>
                             <dd class="col-sm-9">{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'0' }} Fbu</dd>
                             <dt class="col-sm-3">Prix total TVAC </dt>
                             <dd class="col-sm-9">{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2):'0' }} Fbu</dd>
                             <dt class="col-sm-3">Prix en Lettre</dt>
                             <dd class="col-sm-9">Nous disons {{ $proforma_invoice->price_letter}}</dd>
                             <dt class="col-sm-3">Créé par</dt>
                            <dd class="col-sm-9">{{ $proforma_invoice->user->name }}</dd>
                       </dl>
                          <div class="mt-4">
                                               <a href="{{ route('proforma_invoices.edit', $proforma_invoice->id) }}" class="btn btn-primary">
                                                   <i class="bi bi-pencil"></i> Modifier Proforma  #{{ $proforma_invoice->id }}
                                                </a>
                                  </div>
                    </div>
               </div>
                     </div>

 <div class="card shadow mb-4">
        <div class="card-body">

    <h6 class="m-0 font-weight-bold text-primary">Autres détails de la commande </h6>
     <div class="row">
        <p></p>
     </div>
    @php
        $count = 1;
    @endphp
    <table class="table">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Article</th>
                <th>Unite</th>
                <th>Quantité</th>
                <th>Prix unitaire en FBu</th>
                <th>Prix total HT en FBu</th>
                <th>TVA en  FBu</th>
                <th>Prix total TVAC en FBu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proforma_invoice->proformaInvoiceList as $detail)
            <tr>
                <td>{{ $count}}</td>
                <td>{{ $detail->product_name }}</td>
                 <td>{{ $detail->unit }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->unit_price, 2) }}</td>
                <td>{{ number_format($detail->total_price, 2) }}</td>
                <td>{{ $detail->total_price * $proforma_invoice->tva / 100 }}</td>
                <td>{{ number_format( ($detail->total_price + ($detail->total_price * $proforma_invoice->tva / 100)), 2) }}</td>
                <td>
                    <a href="{{ route('proforma_invoices.proforma_invoice_lists.edit', [$proforma_invoice, $detail]) }}" class="btn btn-sm btn-info"> <i class="bi bi-pencil"></i></a>
                    <form action="{{ route('proforma_invoices.proforma_invoice_lists.destroy', [$proforma_invoice, $detail]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ou service ?')">   <i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @php
                $count++;
            @endphp
            @endforeach
        </tbody>
         <tfoot>
            <tr>
                <th colspan="8">Total</th>
                <th>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2) }} Fbu</th>
                <th></th>
            </tr>
               <tr>
                <th colspan="8">TVA</th>
                <th>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2):'0' }} Fbu</th>
                <th></th>
            </tr>
               <tr>
                <th colspan="8">Prix total TVAC</th>
                <th>{{ $proforma_invoice->entreprise->assujeti?number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2):'0' }} Fbu</th>
                <th></th>
            </tr>
        </tfoot> 
    </table>
    </div>
    </div>
    <div>
    <p></p>
    </div>
    <div class="card shadow mb-4 ">
        <div class="card-body">
                <div class="card-body">
    <h6 class="m-0 font-weight-bold text-primary">Ecrivez le prix en Lettre </h6>
     <div class="row">
        <p></p>
     </div>
      <form action="{{ route('addPriceLetter', $proforma_invoice->id) }}" method="POST">
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
                        <i class="bi bi-check-lg"></i> Ajouter à la facture proforma
                    </button>
                    <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
        </div>
        </form>
    </div>
    </div>
      </div>

          <div class="card shadow mb-4">
        <div class="card-body">
    <div class="row">
                        <div class="col-12">
                            <div class="mt-8">
                                <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Retour à la liste proforma
                                </a>
                                    <a href="{{ route('proforma_invoices.generatePDF', $proforma_invoice) }}" class="btn btn-success">
                                     <i class="bi bi-filetype-pdf"></i>
                                        Générer le PDF #{{ $proforma_invoice->id }}
                                 </a>
                                  <a href="{{ route('proforma_invoices.proforma_invoice_lists.create', $proforma_invoice) }}" class="btn btn-primary">
                                               <i class="bi bi-plus-circle"></i> Ajouter Article ou Service
                                 </a>
                                       <a href="{{ route('proforma_invoices.orders.create', $proforma_invoice) }}" class="btn btn-primary">
                                              <i class="bi bi-plus-circle"></i>
                                                   Ajouter Commande
                                        </a>
                                           <a href="{{ route('order_alllist')}}" class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                                 Visualiser Commandes
                                            </a>
                            </div>
                        </div>
                        <p><br></p>
                        </div></div>
  
</div>
@endsection
