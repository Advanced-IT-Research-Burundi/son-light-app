@extends('errors.error')
@section('title', __('Unprocessable Entity'))
@section('code', '422')
@section('content')
<div class="error-icon">
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-8" width="200" height="200" viewBox="0 0 24 24" fill="none">
            <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="rgb(26, 35, 126)" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <span class="error-code">422</span>
</div>

<h1 class="error-title">OUPS ! Données invalides</h1>

<div class="error-message">
    Les données soumises n'ont pas pu être traitées. Veuillez vérifier vos informations et réessayer. <br>
    Si le problème persiste, assurez-vous que tous les champs obligatoires sont remplis correctement..
</div>
@endsection
