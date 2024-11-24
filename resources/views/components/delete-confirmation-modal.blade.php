<div class="modal fade" id="deleteConfirmationModal{{ $id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $id ?? '' }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $id ?? '' }}">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $title ?? 'Confirmation de suppression' }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <p>{{ $message ?? 'Êtes-vous sûr de vouloir effectuer cette action ? Cette opération est irréversible.' }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i> Annuler
                </button>
                <form action="{{ route( $route, $id) }}" method="POST" style="display: inline-block;" class="delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger" >
                        <i class="bi bi-trash me-2"></i> {{ $confirmText ?? 'Supprimer' }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
