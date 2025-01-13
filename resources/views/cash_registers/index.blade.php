@extends('layouts.app')

@section('content')
<div class="container">
  <p> @include('cash_registers.nav')</p>
    <h3 class="mb-4">Liste des Caisses</h3>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('cash_registers.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Créer une Caisse
    </a>
    <div class="table-responsive">
        <table class="table table-bordered" id="proforma_invoicesTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Solde d'Ouverture en BIF</th>
                <th>Solde Actuel en BIF</th>
                <th>Date</th>
                <th>Createur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cashRegisters as $cashRegister)
                <tr>
                    <td>{{ $cashRegister->id }}</td>
                    <td>{{ number_format($cashRegister->opening_balance, 2) }} BIF</td>
                    <td>{{ number_format($cashRegister->current_balance, 2) }} BIF</td>
                    <td>{{ $cashRegister->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ optional($cashRegister->creator)->name ?? 'Inconnu' }}</td>
                    <td>

                        <a href="{{ route('cash_registers.show', $cashRegister) }}" class="btn btn-info btn-sm" title="Afficher">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('cash_registers.details', $cashRegister) }}" class="btn btn-info btn-sm" title="Afficher">
                            <i class="bi bi-receipt"></i>
                        </a>
                        {{--cash_registers.details
                        @if (auth()->user()->isAdmin())
                        <a href="{{ route('cash_registers.edit', $cashRegister) }}" class="btn btn-warning btn-sm" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('cash_registers.destroy', $cashRegister) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette caisse ?');" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endif
                        --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
