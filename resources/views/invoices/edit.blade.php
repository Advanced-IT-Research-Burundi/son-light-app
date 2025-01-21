@extends('layouts.app')

@section('title', 'Modifier une facture')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-pencil-fill"></i> Modifier une facture client #{{ $invoice->id }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group mb-3 col-md-4">
                        <label for="number" class="form-label"><i class="bi bi-file-text"></i> Numéro de facture</label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ $invoice->number }}" required>
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-4">
                        <label for="date" class="form-label"><i class="bi bi-calendar"></i> Date de la facture</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $invoice->date }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-4">
                        <label for="due_date" class="form-label"><i class="bi bi-calendar-plus"></i> Date d'échéance</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ $invoice->due_date }}">
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Modifier la facture</button>
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary"><i class="bi bi-x-circle-fill"></i> Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
