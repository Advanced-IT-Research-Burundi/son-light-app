@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary mb-4">
                <i class="bi bi-plus-circle"></i> Créer une facture client pour la commande #{{ $order->id }}
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.store', ['order_id'=>$order->id]) }}" method="POST">
                @csrf
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
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary"><i class="bi bi-x-lg"></i> Annuler</a>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <h4 class="mt-5"><i class="bi bi-file-earmark-text"></i> Détails de la facture</h4>
            @php
                $count = 1;
            @endphp
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
                    <tbody>
                        @foreach($order->detailOrders as $detail)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $detail->product_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->unit_price, 0, ',', '.') }} </td>
                            <td>{{ number_format($detail->total_price, 0, ',', '.') }} </td>
                            <td>{{ $order->entreprise->assujeti ? number_format($detail->total_price * $order->tva / 100, 0, ',', '.') : 'N/A' }}</td>
                            <td>{{ $order->entreprise->assujeti ? number_format($detail->total_price * (1 + $order->tva / 100), 0, ',', '.') : 'N/A' }}</td>
                            <td>
                                @php
                                    $pvt = $detail->pf + $detail->tc + $detail->atax + ($order->entreprise->assujeti ? ($detail->total_price * (1 + $order->tva / 100)) : 0);
                                @endphp
                                {{ number_format($pvt, 0, ',', '.') }}
                            </td>
                            <td>
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
                                                <form action="{{ route('orders.detail-orders.destroy', [$order, $detail]) }}" method="POST" class="delete-form">
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
                        @php
                            $count++;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"><strong>TOTAUX</strong></td>
                            <td><strong>{{ number_format($order->detailOrders->sum('total_price'), 0, ',', '.') }}</strong></td>
                            <td><strong>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * $order->tva / 100, 0, ',', '.') : 'N/A' }}</strong></td>
                            <td><strong>{{ $order->entreprise->assujeti ? number_format($order->detailOrders->sum('total_price') * (1 + $order->tva / 100), 0, ',', '.') : 'N/A' }}</strong></td>
                            <td><strong>{{ $order->detailOrders->sum(function($detail) {
                                $pvt = $detail->pf + $detail->tc + $detail->atax + $detail->total_price;
                                return $pvt;
                            }) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
