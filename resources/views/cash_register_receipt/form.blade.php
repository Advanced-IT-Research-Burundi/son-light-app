{{-- resources/views/tasks/_form.blade.php --}}

@csrf
<div class="row">
<div class="form-group mb-4 col-6">
    <label for="user_id" class="mb-2"><i class="bi bi-person"></i> Requérant</label>
    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
        <option value="">Sélectionnez un requérant</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ isset($task) && $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-4 col-6">
    <label for="user_id" class="mb-2"><i class="bi bi-person"></i> Assigné à</label>
    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
        <option value="">Sélectionnez un caissier</option>
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
    <label for="end_date" class="mb-2"><i class="bi bi-calendar-check"></i> Date de fin</label>
    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', isset($task) ? $task->end_date->format('Y-m-d') : '') }}" required>
    @error('end_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>

<div class="form-group mb-4">
    <label for="description" class="mb-2"><i class="bi bi-card-text"></i> Motif</label>
    <textarea name="description" id="motif" class="form-control @error('motif') is-invalid @enderror" rows="3">{{ old('description', $cash->motif ?? '') }}</textarea>
    @error('motif')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

