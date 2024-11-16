<!-- resources/views/companies/_form.blade.php -->
<div class="row">
<div class="mb-3 col-6">
    <label for="name" class="form-label">Nom</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $company->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-6">
    <label for="nif" class="form-label">NIF</label>
    <input type="text" class="form-control @error('nif') is-invalid @enderror" id="nif" name="nif" value="{{ old('nif', $company->nif ?? '') }}">
    @error('nif')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
<div class="mb-3 col-6">
    <label for="rc" class="form-label">RC</label>
    <input type="text" class="form-control @error('rc') is-invalid @enderror" id="rc" name="rc" value="{{ old('rc', $company->rc ?? '') }}">
    @error('rc')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-6">
    <label for="assujeti" class="form-label">Assujeti TVA  :  </label><br> 
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
<div class="mb-3 col-6">
    <label for="phone" class="form-label">Téléphone</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $company->phone ?? '') }}">
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3 col-6">
    <label for="email" class="form-label"> E mail</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $company->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
<div class="row">
 <div class="mb-3 col-12">
    <label for="address" class="form-label">Adresse</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $company->address ?? '') }}">
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>

<div class="form-group mb-3">
    <label for="description" class="form-label">
         Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $client->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
