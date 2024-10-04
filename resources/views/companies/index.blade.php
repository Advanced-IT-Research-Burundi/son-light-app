<!-- resources/views/companies/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des entreprises</h1>
    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Ajouter une entreprise</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->phone }}</td>
                <td>{{ $company->email }}</td>
                <td>
                    <a href="{{ route('companies.show', $company) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection