
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'article ou service de la facture proforma #{{ $proforma_invoice->id }}</h1>

    <form action="{{ route('proforma_invoices.proforma_invoice_lists.update', [$proforma_invoice,$proformaInvoiceList]) }}" method="POST">
    @csrf
        @method('PUT')
        @include('proforma_invoice_lists._form')

        <button type="submit" class="btn btn-primary">Mettre à jour l'article ou service</button>
        <a href="{{ route('proforma_invoices.show', $proforma_invoice) }}" class="btn btn-secondary">Annuler</a>
    </form>@extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="my-4">Modifier l'article ou service de la facture proforma #<strong>{{ $proforma_invoice->id }}</strong></h1>

        <form action="{{ route('proforma_invoices.proforma_invoice_lists.update', [$proforma_invoice, $proformaInvoiceList]) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')
            @include('proforma_invoice_lists._form')

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Mettre à jour l'article ou service</button>
                <a href="{{ route('proforma_invoices.show', $proforma_invoice) }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
    <p>
        <br>
        <br>
    </p>
    @endsection
</div>
@endsection
