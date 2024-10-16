
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ajouter une entreprise</h3>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        @include('companies._form')
        <button type="submit" class="btn btn-primary">Créer l'entreprise</button>
    </form>
</div>
@endsection