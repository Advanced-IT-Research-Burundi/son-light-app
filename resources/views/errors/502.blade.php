@extends('errors.error')
@section('title', __('Bad Gateway'))
@section('code', '502')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">502</span>
</div>

<h1 class="error-title">OUPS ! Erreur de passerelle</h1>

<div class="error-message">
    Le serveur a rencontré une erreur temporaire. Cette situation est généralement temporaire. Veuillez réessayer dans quelques instants.    <br>
    Si le problème persiste après plusieurs tentatives, merci de contacter l'administrateur.
</div>
@endsection
