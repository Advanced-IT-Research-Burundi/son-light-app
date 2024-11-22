@extends('errors.error')
@section('title', __('Internal Server Error'))
@section('code', '500')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" stroke="rgb(26, 35, 126)" stroke-width="2"/>
            <path d="M8 15s1.5 2 4 2 4-2 4-2" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
            <circle cx="9" cy="9" r="1" fill="rgb(26, 35, 126)"/>
            <circle cx="15" cy="9" r="1" fill="rgb(26, 35, 126)"/>
        </svg>
    </div>
    <span class="error-code">500</span>
</div>

<h1 class="error-title">OUPS ! Erreur Serveur Interne</h1>

<div class="error-message">
    Une erreur inattendue s'est produite sur nos serveurs. Veuillez patienter quelques minutes et rafraîchir la page. <br>
    Si l'erreur persiste, merci de contacter l'administrateur système en précisant l'heure et les actions effectuées lors de l'erreur.
</div>
@endsection
