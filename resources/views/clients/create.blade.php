<!-- resources/views/clients/create.blade.php -->

@extends('layouts.app')

@section('title', 'Créer un client')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-person-plus"></i> Créer un nouveau client
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                @include('clients._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer le client
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