{{--
    @extends('layouts.app')

    @section('content')
        materialUsage.edit template
    @endsection
--}}
<!-- resources/views/materialUsage/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier une commande')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-pencil"></i> Modifier le materiel utilisé #{{ $materialUsage->id }}
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('material-usages.update', $materialUsage->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('materialUsage._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour le materiel utilisé
                    </button>
                    <a href="{{ route('material-usages.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
