<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">
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
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="bi bi-trash me-2"></i> {{ $confirmText ?? 'Supprimer' }}
                </button>
            </div>
        </div>
    </div>
</div>
