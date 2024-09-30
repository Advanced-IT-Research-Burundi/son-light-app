
@extends('layouts.app')

@section('title', 'Gestion des utlisations materielles')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-cart3"></i> Gestion de materiel utilisé
    </h1>

    <div class="mb-4">
        <a href="{{ route('material-usages.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvel materiel utilisé
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste d' utlisation materielle</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-browed" id="rowsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom du produit</th>
                            <th>Quantite</th>
                            <th>Numero du tache</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp

                    <tbody>
                        @foreach($materialUsages as $row)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $row->stock->product_name ?? ''}}</td>
                            <th>{{ $row->quantity_used ?? ''}}</th>
                            <td>
                                <a href="{{ route('tasks.show',$row->task->id)}}">

                                    {{ $row->task->id ?? ''}}
                                </a>
                            </td>
                            <td>{{ $row->usage_date }}</td>
                            <td>
                                <a href="{{ route('material-usages.show', $row->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('material-usages.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('material-usages.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce materiel utilisé ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
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
    $('#rowsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
