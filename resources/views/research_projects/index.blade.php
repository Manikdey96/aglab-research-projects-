@extends('layouts.app')

@section('title', 'All Research Projects')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Research Projects</h3>
    </div>

    <form method="GET" action="{{ route('research-projects.index') }}" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                   placeholder="Search by title, PI, or research area...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- All Status --</option>
                <option value="upcoming" @selected(request('status') == 'upcoming')>Upcoming</option>
                <option value="ongoing" @selected(request('status') == 'ongoing')>Ongoing</option>
                <option value="completed" @selected(request('status') == 'completed')>Completed</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('research-projects.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    @if($projects->isEmpty())
        <div class="alert alert-info">No research projects found.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card h-100">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $project->title }}">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <span class="badge bg-{{ $project->statusColor() }} text-capitalize">{{ $project->status }}</span>
                            </div>
                            <p class="text-muted mb-1"><strong>PI:</strong> {{ $project->principal_investigator }}</p>
                            @if($project->research_area)
                                <p class="text-muted mb-1"><strong>Area:</strong> {{ $project->research_area }}</p>
                            @endif
                            <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white d-flex gap-2">
                            <a href="{{ route('research-projects.show', $project) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('research-projects.edit', $project) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('research-projects.destroy', $project) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this project?');" class="ms-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    @endif

@endsection
