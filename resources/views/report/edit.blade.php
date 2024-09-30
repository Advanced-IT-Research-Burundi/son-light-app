{{--
    @extends('layouts.app')

    @section('content')
        report.edit template
    @endsection
--}}
<!-- resources/views/raports/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Modifier le rapport')

@section('content')
<div class="container">
    <h1 class="my-4">
        <i class="bi bi-pencil"></i> Modifier le rapport #{{ $report->id }}
    </h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('reports.update', $report->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('report._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Mettre à jour le rapport
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
