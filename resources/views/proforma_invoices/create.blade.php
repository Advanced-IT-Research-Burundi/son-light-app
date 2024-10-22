<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('title', 'Créer la facture proforma')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer la nouvelle facture proforma
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('proforma_invoices.store') }}" method="POST">
                @csrf

                @include('proforma_invoices._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer la facture proforma
                    </button>
                    <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection