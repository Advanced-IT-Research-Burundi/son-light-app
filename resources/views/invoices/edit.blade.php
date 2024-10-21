@extends('layouts.app')

@section('content')
@section('title', 'Modification de la facture')
@section('content')
<div class="container">
    <h3> <i class="bi bi-pencil">Modifier une facture #{{ $invoice->id }}</h3>
     <form action="{{ route('invoices.update',$invoice->id)}}" method="POST">
          @csrf
          @method('PUT')
    <div class="row">
        <div class="form-group mb-3 col-4">
            <label for="number" class="form-label">Numéro de facture</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ $invoice->number }}" required>
        </div>

        <div class="form-group mb-3 col-4">
            <label for="date" class="form-label">Date de la facture</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $invoice->date}}" required>
        </div>

        <div class="form-group mb-3 col-4">
            <label for="due_date" class="form-label">Date d'échéance</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $invoice->due_date }}" required>
        </div>
    </div>
   
</div>
        <button type="submit" class="btn btn-primary">Modifier la facture</button>
       <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary">Annuler</a>
    </form>
    </div>
@endsection