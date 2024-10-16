{{-- resources/views/tasks/_form.blade.php --}}

@csrf
<div class="row">
<div class="form-group mb-4 col-6">
    <label for="order_id" class="mb-2"><i class="bi bi-cart3"></i> Commande</label>
    <select name="order_id" id="order_id" class="form-control @error('order_id') is-invalid @enderror" required>
        <option value="">Sélectionnez une commande</option>
        @foreach($orders as $order)
            <option value="{{ $order->id }}" {{ isset($task) && $task->order_id == $order->id ? 'selected' : '' }}>#{{ $order->id }}   : {{ $order->designation }}</option>
        @endforeach
    </select>
    @error('order_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-4 col-6">
    <label for="user_id" class="mb-2"><i class="bi bi-person"></i> Assigné à</label>
    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
        <option value="">Sélectionnez un utilisateur</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ isset($task) && $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
<div class="form-group mb-4 col-4">
    <label for="status" class="mb-2"><i class="bi bi-flag"></i> Statut</label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
        <option value="en attente" {{ isset($task) && $task->status == 'en attente' ? 'selected' : '' }}>En attente</option>
        <option value="en cours" {{ isset($task) && $task->status == 'en cours' ? 'selected' : '' }}>En cours</option>
        <option value="terminée" {{ isset($task) && $task->status == 'terminée' ? 'selected' : '' }}>Terminée</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-4 col-4">
    <label for="start_date" class="mb-2"><i class="bi bi-calendar-event"></i> Date de début</label>
    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($task) ? $task->start_date->format('Y-m-d') : '') }}" required>
    @error('start_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-4 col-4">
    <label for="end_date" class="mb-2"><i class="bi bi-calendar-check"></i> Date de fin</label>
    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', isset($task) ? $task->end_date->format('Y-m-d') : '') }}" required>
    @error('end_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>

<div class="form-group mb-4">
    <label for="description" class="mb-2"><i class="bi bi-card-text"></i> Description</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

