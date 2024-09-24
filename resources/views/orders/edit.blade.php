<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier une commande')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-pencil"></i> Modifier la commande #{{ $order->id }}
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('orders._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour la commande
                    </button>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection