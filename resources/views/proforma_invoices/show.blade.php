@extends('layouts.app')

@section('title', 'Détails de la facture pro forma')

@section('content')
<style>
    .card {
        border: 1px solid #d1d1d1;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #0043A4;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .table th {
        background-color: #f8f9fa;
        color: #333;
    }

    .table td {
        vertical-align: middle;
    }

    .btn {
        min-width: 150px;
    }

    .highlight {
        background-color: #e7f3fe;
    }

    .invalid-feedback {
        display: block;
    }
</style>

<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la facture pro forma #{{ $proforma_invoice->id }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header">
            Informations de la facture pro forma
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Date de création</dt>
                <dd class="col-sm-9 highlight">{{ \Carbon\Carbon::parse($proforma_invoice->created_at)->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-3">Date de facturation</dt>
                <dd class="col-sm-9 highlight">{{ \Carbon\Carbon::parse($proforma_invoice->proforma_invoice_date)->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Numéro de la facture</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->invoice_number }}</dd>

                <dt class="col-sm-3">Client</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->client?->name ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Entreprise</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->entreprise->name ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Désignation</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->designation ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Unité de mesure</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->unit }}</dd>

                <dt class="col-sm-3">Prix total HTVA</dt>
                <dd class="col-sm-9 highlight">{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2, ',', ' ') }} Fbu</dd>

                <dt class="col-sm-3">TVA :</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2, ',', ' ') : '0' }} Fbu</dd>

                <dt class="col-sm-3">Prix total TVAC</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2, ',', ' ') : '0' }} Fbu</dd>

                <dt class="col-sm-3">Prix en lettres</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->price_letter ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Créé par</dt>
                <dd class="col-sm-9 highlight">{{ $proforma_invoice->user->name }}</dd>
            </dl>

            <h6 class="mt-4">Détails de la commande</h6>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Article</th>
                        <th>Unité</th>
                        <th>Qté</th>
                        <th>P.U</th>
                        <th>PTHTA</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($proforma_invoice->proformaInvoiceList as $detail)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->unit }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price, 0, ',', '.') }} Fbu</td>
                        <td>{{ number_format($detail->total_price, 0, ',', '.') }} Fbu</td>
                        <td>
                            <a href="{{ route('proforma_invoices.proforma_invoice_lists.edit', [$proforma_invoice, $detail]) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $detail->id }}" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>

                            <!-- Modal de confirmation -->
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
                                            <p>Êtes-vous sûr de vouloir supprimer cet article ou service ? Cette action est irréversible.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle me-2"></i> Annuler
                                            </button>
                                            <form action="{{ route('proforma_invoices.proforma_invoice_lists.destroy', [$proforma_invoice, $detail]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash me-2"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php $count++; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th>{{ number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 0, ',', ' ') }} Fbu</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="5">TVA</th>
                        <th>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 0, ',', ' ') : '0' }} Fbu</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th colspan="5">PTVAC</th>
                        <th>{{ $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 0, ',', ' ') : '0' }} Fbu</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h6 class="m-0 font-weight-bold text-primary">Veuillez écrire le prix en toutes lettres en commençant par "Nous disons".</h6>
            <form action="{{ route('addPriceLetter', $proforma_invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group mb-3 col-8">
                        <input type="text" class="form-control @error('price_letter') is-invalid @enderror" id="price_letter" name="price_letter" value="{{ old('price_letter', $proforma_invoice->price_letter ?? '') }}" required>
                        @error('price_letter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3 col-4 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Valider
                        </button>
                        <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="mt-8">
                        <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste pro forma
                        </a>
                        <a href="{{ route('proforma_invoices.generatePDF', $proforma_invoice) }}" class="btn btn-success">
                            <i class="bi bi-filetype-pdf"></i> Générer PDF
                        </a>
                        <a href="{{ route('proforma_invoices.proforma_invoice_lists.create', $proforma_invoice) }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Article ou Service
                        </a>
                        <a href="{{ route('proforma_invoices.orders.create', $proforma_invoice) }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Commande
                        </a>
                        <a href="{{ route('order_alllist') }}" class="btn btn-primary">
                            <i class="bi bi-eye"></i> Commandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p>
        <br><br><br>
    </p>
</div>
@endsection
