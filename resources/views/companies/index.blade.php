<!-- resources/views/companies/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-building"></i> Gestion des entreprises
    </h1>

    <div class="mb-4">
        <a href="{{ route('companies.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i>Ajouter une entreprise
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des entreprises</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="CompanyTable" width="100%" cellspacing="0">
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
                    <a href="{{ route('companies.show', $company) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    {{-- <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#CompanyTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection

