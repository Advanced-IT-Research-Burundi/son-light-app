@extends('layouts.app')

@section('title', 'Détails de la facture pro forma')

@section('content')
<div class="container-fluid">
    <h3 class="my-4 text-primary">
        <i class="bi bi-bag"></i> Détails de la facture proforma #{{ $proforma_invoice->id }}
    </h3>

    <!-- Informations générale -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span>Informations générale</span>
            <a href="{{ route('proforma_invoices.edit', $proforma_invoice->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                <i class="bi bi-pencil"></i> Modifier
            </a>
        </div>
        <div class="card-body">
            <dl class="row">
                @foreach([
                    'Date de création' => \Carbon\Carbon::parse($proforma_invoice->created_at)->format('d/m/Y H:i'),
                    'Date de facturation' => \Carbon\Carbon::parse($proforma_invoice->proforma_invoice_date)->format('d/m/Y'),
                    'Numéro de la facture' => $proforma_invoice->invoice_number,
                    'Client' => $proforma_invoice->client?->name ?? 'Non spécifié',
                    'Entreprise' => $proforma_invoice->entreprise->name ?? 'Non spécifié',
                    'Désignation' => $proforma_invoice->designation ?? 'Non spécifié',
                    'Unité de mesure' => $proforma_invoice->unit,
                    'Prix total HTVA' => number_format($proforma_invoice->proformaInvoiceList->sum('total_price'), 2, ',', ' ') . ' Fbu',
                    'TVA :' => $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * $proforma_invoice->tva / 100, 2, ',', ' ') : '0',
                    'Prix total TVAC' => $proforma_invoice->entreprise->assujeti ? number_format($proforma_invoice->proformaInvoiceList->sum('total_price') * (1 + $proforma_invoice->tva / 100), 2, ',', ' ') : '0',
                    'Prix en lettres' => $proforma_invoice->price_letter ?? 'Non spécifié',
                    'Créé par' => $proforma_invoice->user->name,
                ] as $label => $value)
                    <dt class="col-sm-4">{{ $label }}</dt>
                    <dd class="col-sm-8 highlight">{{ $value }}</dd>
                @endforeach
            </dl>
            <h6 class="mt-4">Détails de la facture pro forma</h6>
            <table class="table table-bordered table-striped table-hover mt-3">
                <thead class="table-light">
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
                    @foreach($proforma_invoice->proformaInvoiceList as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->unit }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price, 0, ',', '.') }} Fbu</td>
                        <td>{{ number_format($detail->total_price, 0, ',', '.') }} Fbu</td>
                        <td>
                            <a href="{{ route('proforma_invoices.proforma_invoice_lists.edit', [$proforma_invoice, $detail]) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('proforma_invoices.proforma_invoice_lists.destroy', [$proforma_invoice, $detail]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ou service ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
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
            <a href="{{ route('proforma_invoices.proforma_invoice_lists.create', $proforma_invoice) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Article ou Service
            </a>
            <h6 class="m-0 font-weight-bold text-primary mt-4">Veuillez écrire le prix en toutes lettres en commençant par "Nous disons".</h6>
            <form action="{{ route('addPriceLetter', $proforma_invoice->id) }}" method="POST" class="mt-3">
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
            <div class="col-12 text-right mt-3">
                <a href="{{ route('proforma_invoices.generatePDF', $proforma_invoice) }}" class="btn btn-success">
                    <i class="bi bi-filetype-pdf"></i> Générer PDF
                </a>
                <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste proforma
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
