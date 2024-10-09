<!-- resources/views/companies/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'entreprise</h1>
    <dl class="row">
        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $company->name }}</dd>

        <dt class="col-sm-3">NIF</dt>
        <dd class="col-sm-9">{{ $company->nif }}</dd>


        <dt class="col-sm-3">RC</dt>
        <dd class="col-sm-9">{{ $company->rc }}</dd>

        <dt class="col-sm-3">ASSUJETI</dt>
        <dd class="col-sm-9">{{ $company->assujeti ? 'OUI' : 'NON' }}</dd>



        <dt class="col-sm-3">Téléphone</dt>
        <dd class="col-sm-9">{{ $company->phone ?? 'Non spécifié' }}</dd>

        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9">{{ $company->email ?? 'Non spécifié' }}</dd>

        <dt class="col-sm-3">Adresse</dt>
        <dd class="col-sm-9">{{ $company->address ?? 'Non spécifiée' }}</dd>

    </dl>
    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary">Modifier</a>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
