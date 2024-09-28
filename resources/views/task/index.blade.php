@extends('layouts.app')

@section('title', 'Gestion des Tâches')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-list-task"></i> Gestion des Tâches
    </h1>

    <div class="mb-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle Tâche
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Tâches</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tasksTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Commande</th>
                            <th>Créé par</th>
                            <th>Assigné à</th>
                            <th>Statut</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>#{{ $task->order->id }}  : {{ $task->order->designation }} </td>
                            <td>{{ $task->creator->name }}</td>
                            <td>{{ $task->user->name }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->start_date->format('d/m/Y') }}</td>
                            <td>{{ $task->end_date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
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
    $('#tasksTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
