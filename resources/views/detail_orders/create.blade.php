<!-- resources/views/detail_orders/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un produit à la commande #{{ $order->id }}</h1>

    <form action="{{ route('orders.detail-orders.store', $order) }}" method="POST">
        @csrf
        @include('detail_orders._form')

        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection