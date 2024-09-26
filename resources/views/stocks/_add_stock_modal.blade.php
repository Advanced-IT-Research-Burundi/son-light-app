<!-- resources/views/stocks/_add_stock_modal.blade.php -->

<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel">Ajouter du stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('stock-movements.store') }}" method="POST">
                @csrf
                <input type="hidden" name="stock_id" id="addStockId">
                <input type="hidden" name="type" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addQuantity" class="form-label">Quantité à ajouter</label>
                        <input type="number" class="form-control" id="addQuantity" name="quantity" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="addReason" class="form-label">Raison</label>
                        <input type="text" class="form-control" id="addReason" name="reason">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>