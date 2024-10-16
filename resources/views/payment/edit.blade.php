{{--

@section('content')
payment.edit template
@endsection
--}}
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="my-4">
        <i class="bi bi-pencil"></i> Modifier le payement #{{ $payment->id }}
    </h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Détails du payment</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @method('PUT')
                @include('payment._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Mettre à jour le payment
                </button>
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
            </form>
        </div>
    </div>
</div>
@endsection

