@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3>Ajouter Dénomination</h3>
    <form action="{{ route('denominations.store') }}" method="POST">
        @csrf
        @include('denominations.form')
        <br>
        <button type="submit" class="btn btn-success">Ajouter Dénomination</button>
        <a href="{{ route('denominations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
