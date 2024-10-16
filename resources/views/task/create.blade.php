@extends('layouts.app')

@section('title', 'Créer une nouvelle tâche')

@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer une nouvelle tâche
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails de la tâche</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @include('task._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer la tâche
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
