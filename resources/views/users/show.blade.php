<!-- resources/views/orders/show.blade.php -->
@extends('layouts.app')
@section('title', 'Détails de la commande')
@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-eye"></i> Détails de l'utilisateur #{{ $user->name }}
    </h1>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de l'utilisateur</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nom et Prénom</dt>
                <dd class="col-sm-9">{{ $user->name }}</dd>

                <dt class="col-sm-3">E Mail</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Role</dt>
                <dd class="col-sm-9">{{ $user->role->name ?? 'Non Role' }}</dd>


                <dt class="col-sm-3">Date de création</dt>
                <dd class="col-sm-9">{{ $user->created_at->format('d/m/Y') }}</dd>

             </dl>
        </div>
    </div>

    <div class="my-4 ">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>



</div>

<div class="container">
    <h1>Détails des taches liés  à {{ $user->name }}</h1>

    @php
        $count = 1;
    @endphp
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
                @foreach($user->tasks as $task)
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
@endsection
