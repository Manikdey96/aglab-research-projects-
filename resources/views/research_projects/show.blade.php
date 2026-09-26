@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <div class="card">
        @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" style="max-height:350px;object-fit:cover;" alt="{{ $project->title }}">
        @endif
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <h3>{{ $project->title }}</h3>
                <span class="badge bg-{{ $project->statusColor() }} text-capitalize fs-6">{{ $project->status }}</span>
            </div>

            <p class="text-muted">
                <strong>Principal Investigator:</strong> {{ $project->principal_investigator }}
            </p>

            @if($project->research_area)
                <p><strong>Research Area:</strong> {{ $project->research_area }}</p>
            @endif

            @if($project->funding_source)
                <p><strong>Funding Source:</strong> {{ $project->funding_source }}</p>
            @endif

            @if($project->budget)
                <p><strong>Budget:</strong> {{ number_format($project->budget, 2) }} BDT</p>
            @endif

            <p><strong>Start Date:</strong> {{ $project->start_date->format('d M, Y') }}</p>

            @if($project->end_date)
                <p><strong>End Date:</strong> {{ $project->end_date->format('d M, Y') }}</p>
            @endif

            <hr>
            <h5>Description</h5>
            <p style="white-space: pre-line;">{{ $project->description }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('research-projects.edit', $project) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('research-projects.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
