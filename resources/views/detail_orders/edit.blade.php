<!-- resources/views/detail_orders/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Modifier l'article ou le service de la commande #{{ $order->id }}</h3>

    <form action="{{ route('orders.detail-orders.update', [$order, $detailOrder]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('detail_orders._form')

        <button type="submit" class="btn btn-primary">Mettre à jour l'article ou le service</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection