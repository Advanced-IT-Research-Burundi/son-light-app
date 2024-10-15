<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier un utilisateur')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-person-gear"></i> Modifier l'utilisateur : {{ $user->name }}
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('users._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour l'utilisateur
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection