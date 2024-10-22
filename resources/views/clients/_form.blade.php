<!-- resources/views/clients/_form.blade.php -->
<div class="row">
    
<div class="form-group mb-3 col-4">
    <label for="name" class="form-label">
        <i class="bi bi-person"></i> Nom & Prénom
    </label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $client->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3 col-4">
    <label for="email" class="form-label">
        <i class="bi bi-envelope"></i> Email
    </label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $client->email ?? '') }}" >
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3 col-4">
    <label for="phone" class="form-label">
        <i class="bi bi-telephone"></i> Téléphone
    </label>
    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $client->phone ?? '') }}">
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
<div class="form-group mb-3 col-3">
    <label for="company" class="form-label">
        <i class="bi bi-building"></i> Entreprise
    </label>
    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company', $client->company ?? '') }}">
    @error('company')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-3">
    <label for="company" class="form-label">
        <i class="bi bi-building"></i> NIF
    </label>
    <input type="text" class="form-control @error('nif') is-invalid @enderror" id="nif" name="nif" value="{{ old('nif', $client->nif ?? '') }}">
    @error('nif')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-3">
    <label for="rc" class="form-label">RC</label>
    <input type="text" class="form-control @error('rc') is-invalid @enderror" id="rc" name="rc" value="{{ old('rc', $client->rc ?? '') }}">
    @error('rc')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-3">
    <br><br>
    <label for="assujeti" class="form-label">Assujeti TVA  :  </label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="assujeti" id="inlineRadio1"  value="1">
        <label class="form-check-label" for="inlineRadio1">OUI</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="assujeti" id="inlineRadio2" value="0">
        <label class="form-check-label" for="inlineRadio2">NON</label>
    </div>
    @error('assujeti')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
<div class="form-group mb-3 col-6">
    <label for="persone_reference1" class="form-label">
        <i class="bi bi-person"></i>Premiere personnne de reference avec son Tel
    </label>
    <input type="text" class="form-control @error('persone_reference1') is-invalid @enderror" id="persone_reference1" name="persone_reference1" value="{{ old('persone_reference1', $client->persone_reference1 ?? '') }}" >
    @error('persone_reference1')
        <div class="invalid-feedback">{{ $persone_reference1 }}</div>
    @enderror
</div>
<div class="form-group mb-3 col-6">
    <label for="persone_reference2" class="form-label">
        <i class="bi bi-person"></i> Seconde personnne de reference avec son Tel
    </label>
    <input type="text" class="form-control @error('persone_reference2') is-invalid @enderror" id="persone_reference2" name="persone_reference2" value="{{ old('persone_reference2', $client->persone_reference2 ?? '') }}" >
    @error('persone_reference2')
        <div class="invalid-feedback">{{ $persone_reference2 }}</div>
    @enderror
</div>
</div>
<div class="form-group mb-3">
    <label for="address" class="form-label">
        <i class="bi bi-geo-alt"></i> Adresse
    </label>
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $client->address ?? '') }}</textarea>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="description" class="form-label">
        <i class="bi bi-chat-left-text"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $client->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
