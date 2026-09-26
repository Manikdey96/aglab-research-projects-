<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ResearchProjectController extends Controller
{
    /**
     * Display a listing of the resource (with optional search + status filter).
     */
    public function index(Request $request)
    {
        $query = ResearchProject::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('principal_investigator', 'like', "%{$search}%")
                  ->orWhere('research_area', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(8)->withQueryString();

        return view('research_projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('research_projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('research_projects', 'public');
        }

        ResearchProject::create($validated);

        return redirect()
            ->route('research-projects.index')
            ->with('success', 'Research project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchProject $researchProject)
    {
        return view('research_projects.show', ['project' => $researchProject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchProject $researchProject)
    {
        return view('research_projects.edit', ['project' => $researchProject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchProject $researchProject)
    {
        $validated = $this->validateData($request, $researchProject->id);

        if ($request->hasFile('image')) {
            // remove old image if it exists
            if ($researchProject->image) {
                Storage::disk('public')->delete($researchProject->image);
            }
            $validated['image'] = $request->file('image')->store('research_projects', 'public');
        }

        $researchProject->update($validated);

        return redirect()
            ->route('research-projects.index')
            ->with('success', 'Research project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchProject $researchProject)
    {
        if ($researchProject->image) {
            Storage::disk('public')->delete($researchProject->image);
        }

        $researchProject->delete();

        return redirect()
            ->route('research-projects.index')
            ->with('success', 'Research project deleted successfully.');
    }

    /**
     * Shared validation rules for store & update.
     */
    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title'                   => 'required|string|max:255',
            'description'             => 'required|string',
            'principal_investigator'  => 'required|string|max:255',
            'research_area'           => 'nullable|string|max:255',
            'funding_source'          => 'nullable|string|max:255',
            'budget'                  => 'nullable|numeric|min:0',
            'status'                  => ['required', Rule::in(['upcoming', 'ongoing', 'completed'])],
            'start_date'              => 'required|date',
            'end_date'                => 'nullable|date|after_or_equal:start_date',
            'image'                   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        return $validated;
    }
}
