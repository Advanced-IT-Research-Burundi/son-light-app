<!-- resources/views/clients/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier un client')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-pencil"></i> Modifier le client : {{ $client->name }}
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('clients._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour le client
                    </button>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection