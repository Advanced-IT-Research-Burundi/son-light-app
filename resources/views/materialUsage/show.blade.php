{{--
    @extends('layouts.app')

    @section('content')
        materialUsage.show template
    @endsection
--}}

<!-- resources/views/materialUsages/show.blade.php -->

@extends('layouts.app')

@section('title', 'Détails de la commande')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-bag"></i> Détails de la matielle utilisé #{{ $materialUsage->id }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la matielle utilisé</h6>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Numéro </dt>
                <dd class="col-sm-9">{{ $materialUsage->id }}</dd>

                <dt class="col-sm-3">Stock</dt>
                <dd class="col-sm-9">{{ $materialUsage->stock->product_name }}</dd>

                <dt class="col-sm-3">Numéro de la tache</dt>
                <dd class="col-sm-9">
                    <a href="{{ route('tasks.show',$materialUsage->task->id)}}">

                        {{ $materialUsage->task->id ?? ''}}
                    </a>
                </dd>

                <dt class="col-sm-3">Quantite</dt>
                <dd class="col-sm-9">{{ $materialUsage->quantity_used ?? 'Non spécifié' }}</dd>

                <dt class="col-sm-3">Date d'utilisation</dt>
                <dd class="col-sm-9">{{ $materialUsage->usage_date->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $materialUsage->description ?? 'Aucune description' }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-4">
           <a href="{{ route('material-usages.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="{{ route('material-usages.edit', $materialUsage->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
    </div>
</div>
@endsection
