@csrf

<div class="mb-3">
    <label class="form-label">Project Title *</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $project->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description *</label>
    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $project->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Principal Investigator *</label>
        <input type="text" name="principal_investigator" class="form-control @error('principal_investigator') is-invalid @enderror"
               value="{{ old('principal_investigator', $project->principal_investigator ?? '') }}" required>
        @error('principal_investigator') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Research Area</label>
        <input type="text" name="research_area" class="form-control @error('research_area') is-invalid @enderror"
               value="{{ old('research_area', $project->research_area ?? '') }}"
               placeholder="e.g. Plant Abiotic Stress Biology">
        @error('research_area') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Funding Source</label>
        <input type="text" name="funding_source" class="form-control @error('funding_source') is-invalid @enderror"
               value="{{ old('funding_source', $project->funding_source ?? '') }}">
        @error('funding_source') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Budget (BDT)</label>
        <input type="number" step="0.01" name="budget" class="form-control @error('budget') is-invalid @enderror"
               value="{{ old('budget', $project->budget ?? '') }}">
        @error('budget') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach(['upcoming', 'ongoing', 'completed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $project->status ?? '') == $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Start Date *</label>
        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
               value="{{ old('start_date', isset($project->start_date) ? $project->start_date->format('Y-m-d') : '') }}" required>
        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
               value="{{ old('end_date', isset($project->end_date) && $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Project Image</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

    @if(!empty($project->image))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $project->image) }}" style="height:100px;" alt="current image">
            <p class="text-muted small mb-0">Current image (uploading a new one will replace it)</p>
        </div>
    @endif
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-success">Save Project</button>
    <a href="{{ route('research-projects.index') }}" class="btn btn-secondary">Cancel</a>
</div>
