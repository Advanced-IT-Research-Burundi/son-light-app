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
                <table class="table table-braported" id="raports" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Description</th>
                            <td>Utilisateur</td>
                            @if (auth()->user()->isAdmin())
                            <th>Actions</th>
                            @endif
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
                            @if (auth()->user()->isAdmin())
                            <td>
                                {{-- <a href="{{ route('reports.show', $raport->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a> --}}

                                    <a href="{{ route('reports.edit', $raport->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $raport->id}}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <!-- Composant modal -->
                                    @include('components.delete-confirmation-modal', [
                                        'id'=>  $raport->id,
                                        'route'=> 'reports.destroy',
                                        'title' => 'Confirmation de suppression',
                                        'message' => 'Êtes-vous sûr de vouloir supprimer ce rapport ?',
                                        'confirmText' => 'Supprimer'
                                    ])

                                </td>
                            @endif
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
    $(document).ready(function(){

        $('#raports').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
                },
            // "processing" : true,
            // "serverSide" : true,
            // "ajax" : {
            // url:"fetch.php",
            // type:"POST"
            // },
            dom: 'lBfrtip',
            buttons: [
            'excel', 'csv', 'pdf', 'copy'
            ],
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });

        });

</script>
@endsection
