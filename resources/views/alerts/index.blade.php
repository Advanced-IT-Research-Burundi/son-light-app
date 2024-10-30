<!-- resources/views/alerts/index.blade.php -->

@extends('layouts.app')

@section('title', 'Alertes')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-exclamation-triangle"></i> Alertes
    </h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0"><i class="bi bi-box-seam"></i> Alertes de stock</h5>
                </div>
                <div class="card-body">
                    @if($stockAlerts->isEmpty())
                        <p>Aucune alerte de stock.</p>
                    @else
                        <ul class="list-group">
                            @foreach($stockAlerts as $stock)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $stock->product_name }}
                                    <span class="badge bg-danger rounded-pill">
                                        {{ $stock->quantity }} / {{ $stock->min_quantity }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="bi bi-calendar-event"></i> Alertes de commandes</h5>
                </div>
                <div class="card-body">
                    @if($orderAlerts->isEmpty())
                        <p>Aucune alerte de commande.</p>
                    @else
                        <ul class="list-group">
                            @foreach($orderAlerts as $order)
                             @if($order->status_livraison==2)
                                <li class="list-group-item">
                                    <h6>Commande #{{ $order->id }} - {{ $order->client->name }}</h6>
                                    <p class="mb-0">
                                        Date de livraison : 
                                        <strong class="{{ $order->delivery_date->isPast() ? 'text-danger' : 'text-warning' }}">
                                            {{ $order->delivery_date->format('d/m/Y') }}
                                        </strong>
                                    </p>
                                    <small class="text-muted">
                                        Statut de la commande: {{ $order->status }}
                                    </small>
                                     <small class="text-muted">
                                     <dt class="col-sm-3">La livraison a été  Terminée ?</dt>
                                         @if($order->status_livraison==2)
                                         <dd class="col-sm-9" style="color:red;">Non</dd>
                                     @endif
                                    </small>
                                </li>
                                 @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection