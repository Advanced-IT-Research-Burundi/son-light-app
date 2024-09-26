<!-- resources/views/stocks/_remove_stock_modal.blade.php -->

<div class="modal fade" id="removeStockModal" tabindex="-1" aria-labelledby="removeStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeStockModalLabel">Retirer du stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('stock-movements.store') }}" method="POST">
                @csrf
                <input type="hidden" name="stock_id" id="removeStockId">
                <input type="hidden" name="type" value="remove">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="removeQuantity" class="form-label">Quantité à retirer</label>
                        <input type="number" class="form-control" id="removeQuantity" name="quantity" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="removeReason" class="form-label">Raison</label>
                        <input type="text" class="form-control" id="removeReason" name="reason">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Retirer</button>
                </div>
            </form>
        </div>
    </div>
</div>