@extends('errors.error')
@section('title', __('Page Expired'))
@section('code', '419')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">419</span>
</div>

<h1 class="error-title">OUPS ! Session expirée</h1>

<div class="error-message">
    Votre session a expiré pour des raisons de sécurité. Veuillez rafraîchir la page et réessayer.
</div>
@endsection
