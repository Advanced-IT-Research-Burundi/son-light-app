<!-- resources/views/reports/_form.blade.php -->


<div class="form-group mb-3">
    <label for="type" class="form-label">
        <i class="bi bi-calendar"></i> Titre
    </label>
    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $report->type ?? '') }}" required>
    @error('type')
        <div class="invalid-feedback">{{ $type }}</div>
    @enderror
</div>


<div class="form-group mb-3">
    <label for="content" class="form-label">
        <i class="bi bi-text-paragraph"></i> Contenu
    </label>
    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3">{{ old('content', $report->content ?? '') }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="description" class="form-label">
        <i class="bi bi-text-paragraph"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $report->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- <div class="form-group mb-3">
    <label for="report_date" class="form-label">
        <i class="bi bi-calendar"></i> Date
    </label>
    <input type="date" class="form-control @error('report_date') is-invalid @enderror" id="report_date" name="report_date" value="{{ old('report_date', $report->report_date ?? '') }}" required>
    @error('report_date')
        <div class="invalid-feedback">{{ $type }}</div>
    @enderror
</div> --}}
