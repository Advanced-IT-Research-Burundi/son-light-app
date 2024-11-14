<!-- resources/views/detail_orders/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Ajouter un article ou service à la facture proforma #{{ $proforma_invoice->id }}</h4>

    <form action="{{ route('proforma_invoices.proforma_invoice_lists.store', $proforma_invoice) }}" method="POST">
        @csrf
        @include('proforma_invoice_lists._form')

        <button type="submit" class="btn btn-primary">Ajouter l'article ou service</button>
        <a href="{{ route('proforma_invoices.show', $proforma_invoice) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection