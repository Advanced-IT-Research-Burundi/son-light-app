
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une entreprise</h1>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        @include('companies._form')
        <button type="submit" class="btn btn-primary">Créer l'entreprise</button>
    </form>
</div>
@endsection