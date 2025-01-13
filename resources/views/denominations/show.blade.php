@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3>Détails de la Dénomination</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dénomination: {{ number_format($denomination->denomination, 2, '.', ',') }} BIF</h5>
            <p class="card-text">Quantité: {{ $denomination->quantity }}</p>
            <p class="card-text">Total: {{ number_format($denomination->total(), 2, '.', ',') }} BIF</p>
        </div>
    </div>

    <a href="{{ route('denominations.index', $denomination->cashRegister) }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
