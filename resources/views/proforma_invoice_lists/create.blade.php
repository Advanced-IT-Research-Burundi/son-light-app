@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="my-4">Ajouter un article ou service à la facture proforma #<strong>{{ $proforma_invoice->id }}</strong></h4>

    <form action="{{ route('proforma_invoices.proforma_invoice_lists.store', $proforma_invoice) }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf
        @include('proforma_invoice_lists._form')

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Ajouter l'article ou service</button>
            <a href="{{ route('proforma_invoices.show', $proforma_invoice) }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
    <p>
        <br>
        <br>
    </p>
</div>

@endsection
