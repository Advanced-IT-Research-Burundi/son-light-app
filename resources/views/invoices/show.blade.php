@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h3 class="text-primary">
                <i class="bi bi-eye"></i> Facture #{{ $invoice->number }}
                <span class="text-muted">du
                    @if($invoice->date)
                    {{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') }}
                    @else
                    Non spécifiée
                    @endif
                </span>
            </h3>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-file-earmark-text"></i> Détails de la facture</h5>
                </div>
                <div class="card-body">
                    <p><strong>Client :</strong> {{ $invoice->order->client ? $invoice->order->client->name : 'Non spécifié' }}</p>
                    <p><strong>Société facture :</strong> {{ $invoice->order->entreprise ? $invoice->order->entreprise->name : 'Non spécifiée' }}</p>
                    <p><strong>Date de facturation:</strong> {{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') : 'Non spécifiée' }}</p>
                    <p><strong>Date de création :</strong> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</p>
                    <p><strong>Créé par :</strong> {{ $invoice->user_id ? $invoice->user->name : 'Non spécifié' }}</p>
                    <p><strong>Status :</strong> {{ ucfirst($invoice->status) }}</p>
                    <p><strong>Date d'échéance :</strong> {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') : 'Non défini' }}</p>
                    <p><strong>Date de dernière mise à jour :</strong> {{ \Carbon\Carbon::parse($invoice->updated_at)->format('d/m/Y') }}</p>
                    <p><strong>Dernière mise à jour par :</strong> {{ $invoice->updated_by ? $invoice->updatedBy->name : 'Non spécifié' }}</p>


                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-basket-fill"></i> Détails de la commande</h5>
                </div>
                <div class="card-body">
                    <p><strong>Num de la commande :</strong> {{ $invoice->order->id }}</p>
                    <p><strong>Date de commande :</strong> {{ $invoice->order->order_date ? \Carbon\Carbon::parse($invoice->order->order_date)->format('d/m/Y') : 'Non spécifiée' }}</p>
                    <div class="row">
                        <div class="col-4">
                            <p><strong>PF :</strong> {{  number_format($invoice->order->pf, 0, ',', '.')  }}</p>
                        </div>
                        <div class="col-4">
                            <p><strong>TC :</strong> {{  number_format($invoice->order->tc, 0, ',', '.')  }}</p>
                        </div>
                        <div class="col-4">
                            <p><strong>ATAX :</strong> {{  number_format($invoice->order->atax, 0, ',', '.')  }}</p>
                        </div>
                    </div>

                    @php
                        $totalHT = $invoice->order->detailOrders->sum('total_price');
                        $taxRate = 0.18;
                        $TVA = $totalHT * $taxRate;
                        $PVT = $totalHT + $TVA;
                    @endphp

                    @if($invoice->order->entreprise->assujeti)
                        <div class="row">
                            <div class="col-6">
                                <p><strong>PVHT :</strong> {{ number_format($totalHT, 0, ',', '.') }} BIF</p>
                            </div>
                            <div class="col-6">
                                <p><strong>TVA (18%) :</strong> {{ number_format($TVA, 0, ',', '.') }} BIF</p>
                            </div>
                        </div>
                        <p><strong>PVHTVA :</strong> {{ number_format($totalHT, 0, ',', '.') }} BIF</p>
                        <p><strong>TVA :</strong> {{ number_format($TVA, 0, ',', '.') }} BIF</p>
                        <p><strong>TVAC :</strong> {{ number_format($PVT, 0, ',', '.') }} BIF</p>
                        <p><strong>PVT :</strong> {{ number_format($PVT, 0, ',', '.') }} BIF</p>
                    @else
                        <p><strong>PVT :</strong> {{ number_format($totalHT, 0, ',', '.') }} BIF</p>
                    @endif

                    <p><strong>Nous disons :</strong> {{ $invoice->order->price_letter }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-box"></i> Détails des articles</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Article ou service</th>
                                    <th>Qté</th>
                                    <th>PU HT</th>
                                    <th>PT HT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoice->order->detailOrders as $detail)
                                <tr>
                                    <td>{{ $detail->product_name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->unit_price, 0, ',', '.') }} BIF</td>
                                    <td>{{ number_format($detail->total_price, 0, ',', '.') }} BIF</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun détail de commande disponible.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                @if($invoice->order->detailOrders->isNotEmpty())
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                    <td><strong>{{ number_format($invoice->order->detailOrders->sum('total_price'), 0, ',', '.') }} BIF</strong></td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">Aucun total disponible.</td>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary mr-2">
                <i class="bi bi-arrow-left"></i> Retour à la liste des factures
            </a>
            <a href="{{ route('invoices.generatePDF', $invoice) }}" class="btn btn-success">
                <i class="bi bi-filetype-pdf"></i> Télécharger PDF
            </a>
        </div>
    </div>
</div>
@endsection
