<div class="modal fade" id="annuleConfirmationModal{{ $id }}" tabindex="-1" aria-labelledby="annuleConfirmationModal{{ $id ?? '' }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route( $route, $id) }}" method="POST" style="display: inline-block;" class="delete-form">
                @csrf
                @method('POST')
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="annuleConfirmationModal{{ $id ?? '' }}">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $title ?? 'Confirmation de anullation du repart' }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <label for="motif" class="control-label">Motif</label>
                <input type="text" class="form-control" id="motif" name="motif" value="{{ old('motif', $motif ?? '') }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i> Annuler
                </button>


                    <button type="submit" class="btn btn-warning" >
                        <i class="bi bi-x-square me-2"></i> {{ $confirmText ?? 'Supprimer' }}
                    </button>


            </div>
        </form>
        </div>
    </div>
</div>
