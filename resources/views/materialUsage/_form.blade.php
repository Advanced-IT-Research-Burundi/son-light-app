<!-- resources/views/materialUsages/_form.blade.php -->
<div class="row">

<div class="form-group mb-3 col-3">
    <label for="client_id" class="form-label">
        <i class="bi bi-people-fill"></i> Stock
    </label>

    <select class="form-select @error('stock_id') is-invalid @enderror" id="stock_id" name="stock_id" required>
        <option value="">Sélectionnez un élément stock</option>
        @foreach($stocks as $stock)
             <option value="{{ $stock->id }}" {{ isset($stock) && $stock->id == $stock->id ? 'selected' : '' }}> {{ $stock->product_name }}  </option>
        @endforeach
    </select>
    @error('stock_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>
<div class="form-group mb-3 col-3">
    <label for="client_id" class="form-label">
        <i class="bi bi-list-task"></i> Tache
    </label>

    <select class="form-select @error('task_id') is-invalid @enderror" id="task_id" name="task_id" required>
        <option value="">Sélectionnez le numéro du tache</option>
        @foreach($tasks as $task)
            <option value="{{ $task->id }}" {{ isset($task) && $task->id == $task->id ? 'selected' : '' }}> # {{ $task->id }}  </option>
        @endforeach
    </select>
    @error('task_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group mb-3 col-3">
    <label for="materialUsage_date" class="form-label">
        <i class="bi bi-calendar"></i> Quantité
    </label>
    <input type="number" class="form-control @error('quantity_used') is-invalid @enderror" id="quantity_used" name="quantity_used" value="{{ old('quantity_used', $materialUsage->quantity_used ?? '') }}" required>
    @error('quantity_used')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="form-group mb-3 col-3">
    <label for="materialUsage_date" class="form-label">
        <i class="bi bi-calendar"></i> Date d'utilisation
    </label>
    <input type="date" class="form-control @error('usage_date') is-invalid @enderror" id="usage_date" name="usage_date" value="{{ old('usage_date', $materialUsage->usage_date ?? '') }}" required>
    @error('usage_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>

<div class="form-group mb-3 ">
    <label for="description" class="form-label">
        <i class="bi bi-text-paragraph"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $materialUsage->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
