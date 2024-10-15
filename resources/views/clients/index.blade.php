<!-- resources/views/clients/index.blade.php -->

@extends('layouts.app')

@section('title', 'Gestion des clients')

@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-people"></i> Gestion des clients
    </h3>

    <div class="mb-4">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Nouveau client
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des clients</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="clientsTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Entreprise</th>
                            <th>NIF</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>P1 de contact</th>
                            <th>P2 de contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->company ?? 'N/A' }}</td>
                            <td>{{ $client->nif }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone ?? 'N/A' }}</td>
                            <td>{{ $client->persone_reference1 ?? 'N/A' }}</td>
                            <td>{{ $client->persone_reference2 ?? 'N/A'}}</td>
                            <td>
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#clientsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
