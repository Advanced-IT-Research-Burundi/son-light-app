{{--
    @extends('layouts.app')

    @section('content')
        report.create template
    @endsection
--}}

<!-- resources/views/raports/create.blade.php -->

@extends('layouts.app')

@section('title', 'Créer une commande')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer un nouvel rapport
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf

                @include('report._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer le rapport
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
