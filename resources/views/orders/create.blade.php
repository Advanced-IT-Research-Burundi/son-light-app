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
            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">

                @csrf

                @include('orders._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer la commande
                    </button>
                    <a href="{{ route('order_alllist')}}"  class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('orderForm').addEventListener('submit', function(event) {
        // Définir les champs à vérifier
        const tc = document.getElementById('tc');
        const atax = document.getElementById('atax');
        const pf = document.getElementById('pf');

        // Vérifier si les champs sont vides et assigner 0 si c'est le cas
        if (!tc.value.trim()) tc.value = '0';
        if (!atax.value.trim()) atax.value = '0';
        if (!pf.value.trim()) pf.value = '0';
    });
</script>
@stop
@endsection
