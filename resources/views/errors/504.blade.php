@extends('errors.error')
@section('title', __('Gateway Timeout'))
@section('code', '504')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">503</span>
</div>

<h1 class="error-title">OUPS ! Délai d'attente dépassé </h1>

<div class="error-message">
    Le serveur a mis trop de temps à répondre. Cela peut être dû à une connexion internet lente ou à une surcharge temporaire. <br>
    Conseil : Vérifiez votre connexion internet et réessayez dans quelques instants.
</div>
@endsection
