@extends('errors.error')
@section('title', __('Not Found'))
@section('code', '404')
@section('content')
<div class="error-icon">
    <div class="">
        <svg class="w-32 h-32 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2"/>
            <path d="M9 10h.01M15 10h.01M9.5 15.5c.5 1 1.5 2 2.5 2s2-1 2.5-2" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">404</span>
</div>

<h1 class="error-title">OUPS ! Page introuvable </h1>

<div class="error-message">
    La page que vous recherchez semble avoir disparu. Pas d'inquiétude, vous pouvez retourner à la page précédente ou à l'accueil !
</div>
@endsection
