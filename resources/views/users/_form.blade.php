<!-- resources/views/users/_form.blade.php -->

<div class="form-group mb-3">
    <label for="name" class="form-label">
        <i class="bi bi-person"></i> Nom
    </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="email" class="form-label">
        <i class="bi bi-envelope"></i> Email
    </label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="password" class="form-label">
        <i class="bi bi-lock"></i> Mot de passe
    </label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="role" class="form-label">
        <i class="bi bi-person-badge"></i> Rôle
    </label>
    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="">Sélectionnez un rôle</option>
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrateur</option>
        <option value="employee" {{ old('role', $user->role ?? '') == 'employee' ? 'selected' : '' }}>Employé</option>
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>