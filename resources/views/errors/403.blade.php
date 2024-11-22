@extends('errors.error')
@section('title', __('Forbidden'))
@section('code', '403')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M9 9h6m-3 3v3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">403</span>
</div>

<h1 class="error-title">OUPS ! Accès interdit </h1>

<div class="error-message">
    Désolé, vous n'avez pas la permission d'accéder à cette ressource. Si vous pensez qu'il s'agit d'une erreur, contactez l'administrateur.
</div>
@endsection
