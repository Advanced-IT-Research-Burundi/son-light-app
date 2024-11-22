@extends('errors.error')
@section('title', __('Too Many Requests'))
@section('code', '429')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">429</span>
</div>

<h1 class="error-title">OUPS ! Trop de requêtes</h1>

<div class="error-message">
    Vous avez effectué trop de requêtes dans un court laps de temps. Veuillez patienter quelques instants avant de réessayer. <br>
    Conseil : Évitez les actualisations répétées de la page ou les clics multiples sur les boutons.
</div>
@endsection
