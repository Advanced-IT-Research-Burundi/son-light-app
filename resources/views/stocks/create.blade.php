<!-- resources/views/stocks/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter un produit au stock')

@section('content')
<div class="container">
    <h3 class="my-4">
        <i class="bi bi-plus-circle"></i> Ajouter un produit au stock
    </h3>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                @include('stocks._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Ajouter le produit
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection