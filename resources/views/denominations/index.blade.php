@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <p> @include('cash_registers.nav')</p>
    <h3>Dénominations de Caisse</h3>
      <p>
        <a href="{{ route('denominations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Ajouter Dénomination
        </a>
      </p>
    <div class="table-responsive">
        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>Dénomination</th>
                <th>Quantité</th>
                <th>Total par Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGeneral = 0;
            @endphp
            @php
                $i = 1;
            @endphp

            @foreach($denominations as $denomination)
                @php
                    $totalParCategorie = $denomination->denomination * $denomination->quantity;
                    $totalGeneral += $totalParCategorie;
                @endphp
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $denomination->denomination }}</td>
                    <td>{{ $denomination->quantity }}</td>
                    <td >{{ number_format($totalParCategorie, 0, ',', ' ') }} BIF</td>
                    <td>
                        <a href="{{ route('denominations.show', $denomination) }}" class="btn btn-info" title="Afficher les détails">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('denominations.edit', $denomination) }}" class="btn btn-warning" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('denominations.destroy', $denomination) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Général</th>
                <th >{{ number_format($totalGeneral, 0, ',', ' ') }} BIF</th>
            </tr>
        </tfoot>
    </table>
    </div>
    @php
        echo "Nombre d'enregistrements : " . count($denominations);
    @endphp
</div>
@endsection
