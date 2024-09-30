{{--

@section('content')
report.index template
@endsection
--}}<!-- resources/views/raports/index.blade.php -->

@extends('layouts.app')

@section('title', 'Gestion des rapports')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">
        <i class="bi bi-cart3"></i> Gestion des raports
    </h1>

    <div class="mb-4">
        <a href="{{ route('reports.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle rapport
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des rapports</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-braported" id="raportsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Description</th>
                            <td>Utilisateur</td>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $count = 1;
                    @endphp
                    <tbody>
                        @foreach($raports as $raport)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $raport->report_date->format('d/m/Y') }}</td>
                            <td>{{ $raport->type ?? ''}}</td>
                            <td>{{ $raport->content?? ''}}</td>
                            <th>{{ $raport->description ?? ''}}</th>
                            <th> {{ $raport->user->name }}</th>
                            <td>
                                {{-- <a href="{{ route('reports.show', $raport->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a> --}}
                                <a href="{{ route('reports.edit', $raport->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('reports.destroy', $raport->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#raportsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
        }
    });
});
</script>
@endsection
