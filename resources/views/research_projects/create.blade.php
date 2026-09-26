@extends('layouts.app')

@section('title', 'Add New Research Project')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Add New Research Project</h4>
            <form action="{{ route('research-projects.store') }}" method="POST" enctype="multipart/form-data">
                @include('research_projects._form')
            </form>
        </div>
    </div>
@endsection
