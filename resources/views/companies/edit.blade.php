<!-- resources/views/companies/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'entreprise</h1>
    <form action="{{ route('companies.update', $company) }}" method="POST">
        @csrf
        @method('PUT')
        @include('companies._form')
        <button type="submit" class="btn btn-primary">Mettre à jour l'entreprise</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Retour à la liste</a>

    </form>
</div>
@endsection
