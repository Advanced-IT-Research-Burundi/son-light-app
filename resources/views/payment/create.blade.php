{{--

@section('content')
payment.create template
@endsection
--}}

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-plus-circle"></i> Créer un payement
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails du payement</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @include('payment._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer du payement
                </button>
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
