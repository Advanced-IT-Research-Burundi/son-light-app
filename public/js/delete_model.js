let deleteModal;
    let currentForm;

    document.addEventListener('DOMContentLoaded', function() {
        deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    });

    function showDeleteModal(id, message) {
        currentForm = document.querySelector(`form[action*="${id}"]`);
        document.querySelector('#deleteConfirmationModal .modal-body p').textContent = message;
        deleteModal.show();
    }

    function confirmDelete() {
        if (currentForm) {
            currentForm.submit();
        }
    }
