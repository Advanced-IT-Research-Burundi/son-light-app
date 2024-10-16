{{--
    @extends('layouts.app')

    @section('content')
        materialUsage.create template
    @endsection
--}}
<!-- resources/views/materialUsage/create.blade.php -->

@extends('layouts.app')

@section('title', 'Créer un materiel utilisé')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer un materiel utilisé
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('material-usages.store') }}" method="POST">
                @csrf

                @include('materialUsage._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Créer le materiel utilisé
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
