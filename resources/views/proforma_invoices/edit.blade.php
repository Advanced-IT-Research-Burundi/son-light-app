@extends('layouts.app')

@section('title', 'Modifier la facture pro forma')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-pencil"></i> Modifier la facture proforma #{{ $proforma_invoice->id }}
    </h3>

    <div class="alert alert-info" role="alert">
        Modifiez les informations de la facture pro forma ci-dessous. Assurez-vous que toutes les données sont correctes avant de soumettre les modifications.
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('proforma_invoices.update', $proforma_invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('proforma_invoices._form')

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-check-lg"></i> Mettre à jour la facture pro forma
                    </button>
                    <a href="{{ route('proforma_invoices.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
        <p>
            <br><br><br>
        </p>
    </div>
</div>
@endsection
