<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('title', 'Créer une commande')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer une nouvelle commande pour la facture proforma #{{ $proforma_invoice->id }}
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                
                @csrf

                @include('orders._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer la commande
                    </button>
                    <a href=""  class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection