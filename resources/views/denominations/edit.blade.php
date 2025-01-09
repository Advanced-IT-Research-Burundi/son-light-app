@extends('layouts.app')

@section('content')
<div class="container">
    <p> @include('cash_registers.nav')</p>
    <h3>Modifier Dénomination</h3>
    <form action="{{ route('denominations.update', $denomination) }}" method="POST">
        @csrf
        @method('PUT')
        @include('denominations.form')
       <p>
        <br>
        <button type="submit" class="btn btn-primary">Mettre à Jour Dénomination</button>
       </p>
    </form>
</div>
@endsection
