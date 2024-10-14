<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier la facture proforma')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-pencil"></i> Modifier la facture proforma #{{ $proforma_invoice->id }}
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('proforma_invoices.update', $proforma_invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('proforma_invoices._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour la facture proforma
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