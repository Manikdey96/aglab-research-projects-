@extends('layouts.app')

@section('title', 'Edit Research Project')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Edit Research Project</h4>
            <form action="{{ route('research-projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('research_projects._form')
            </form>
        </div>
    </div>
@endsection
