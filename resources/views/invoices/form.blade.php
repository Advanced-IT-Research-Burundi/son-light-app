
        <div class="row mb-4">
            <div class="form-group col-md-6">
                <label for="number" class="form-label">Numéro de facture</label>
                <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $number) }}">
                @error('number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="id_true_invoice" class="form-label">ID de la facture client <small>(Uniquement pour Son Light Paper Services)</small></label>
                <input type="text" class="form-control @error('id_true_invoice') is-invalid @enderror" id="id_true_invoice" name="id_true_invoice" value="{{ old('id_true_invoice') }}" placeholder="4000652612/N860W672409/144707/N860W672409/FN66/2024">
                @error('id_true_invoice')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="form-group col-md-6">
                <label for="date" class="form-label">Date de la facture</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="due_date" class="form-label">Date d'échéance</label>
                <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}">
                @error('due_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
