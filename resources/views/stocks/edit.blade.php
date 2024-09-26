<!-- resources/views/stocks/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier un produit du stock')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-pencil"></i> Modifier le produit : {{ $stock->product_name }}
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('stocks._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour le produit
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