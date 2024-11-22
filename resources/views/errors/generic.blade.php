@extends('errors.error')
@section('title', __('Error'))
@section('code', $code ?? 'Unknown')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2"/>
            <path d="M12 8v4m0 4h.01" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
            <path d="M8.5 8.5l7 7m0-7l-7 7" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>

    </div>
    <span class="error-code"> Code d'erreur: {{ $code ?? 'Inconnu' }}</span>
</div>

<h1 class="error-title">OUPS ! Une erreur est survenue </h1>

<div class="error-message">
    Désolé, quelque chose s'est mal passé. Voici quelques actions que vous pouvez essayer : <br>
    1. Rafraîchissez la page, <br>
    2. Attendez quelques minutes et réessayez, <br> <br>
    Si le problème persiste, notez le code d'erreur et contactez l'administrateur système.
</div>
@endsection
