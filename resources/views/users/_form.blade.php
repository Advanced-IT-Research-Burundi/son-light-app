<!-- resources/views/users/_form.blade.php -->

<div class="row">
<div class="form-group mb-3 col-6">
    <label for="name" class="form-label">
        <i class="bi bi-person"></i> Nom
    </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3 col-6">
    <label for="email" class="form-label">
        <i class="bi bi-envelope"></i> Email
    </label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
<div class="form-group mb-3 col-4">
    <label for="password" class="form-label">
        <i class="bi bi-lock"></i> Mot de passe
    </label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3 col-4">
    <label for="role" class="form-label">
        <i class="bi bi-person-badge"></i> Rôle
    </label>
    <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
        <option value="">Sélectionnez un rôle</option>
        @foreach ($roles as $item)
            <option  value="{{ $item->id }}" {{ old('role_id', $user->role->id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
         </select>
    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-4">
    <label for="role" class="form-label">
        <i class="bi bi-building"></i> Entreprise
    </label>
    <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
        <option value="">Sélectionnez un Entreprise</option>
        @foreach ($companies as $item)
            <option  value="{{ $item->id }}" {{ old('company_id', $user->company->id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
         </select>
    @error('company_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
