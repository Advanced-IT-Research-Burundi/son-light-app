@extends('layouts.app')

@section('title', 'Détails de la tâche')

@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-eye"></i> Détails de la tâche #{{ $task->id }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la tâche</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Commande :</strong> {{ $task->order->id }}</p>
                    <p><strong>Créé par :</strong> {{ $task->creator->name }}</p>
                    <p><strong>Assigné à :</strong> {{ $task->user->name }}</p>
                    <p><strong>Statut :</strong> {{ $task->status }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Date de début :</strong> {{ $task->start_date->format('d/m/Y') }}</p>
                    <p><strong>Date de fin :</strong> {{ $task->end_date->format('d/m/Y') }}</p>
                    <p><strong>Créé le :</strong> {{ $task->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Mis à jour le :</strong> {{ $task->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <h6 class="font-weight-bold">Description :</h6>
                    <p>{{ $task->description ?? 'Aucune description disponible.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
     <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
