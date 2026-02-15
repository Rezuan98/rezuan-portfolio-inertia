<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->get();

        return Inertia::render('Backend/Projects/Index', [
            'projects' => $projects
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'technologies' => 'nullable|string',
            'live_demo_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        Project::create($validated);

        return redirect()->back()->with('success', 'Project added successfully!');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'technologies' => 'nullable|string',
            'live_demo_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $project->update($validated);

        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
}
