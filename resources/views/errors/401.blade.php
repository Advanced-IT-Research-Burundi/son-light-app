@extends('errors.error')
@section('title', __('Unauthorized'))
@section('code', '401')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M9 9h6m-3 3v3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">401</span>
</div>

<h1 class="error-title">OUPS ! Accès non autorisé </h1>

<div class="error-message">
    Il semble que vous n'ayez pas les autorisations nécessaires pour accéder à cette page. Connectez-vous ou contactez l'administrateur.
</div>
@endsection
