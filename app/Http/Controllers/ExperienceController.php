<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::ordered()->get();

        return Inertia::render('Backend/Experiences/Index', [
            'experiences' => $experiences
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        Experience::create($validated);

        return redirect()->back()->with('success', 'Experience added successfully!');
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $experience->update($validated);

        return redirect()->back()->with('success', 'Experience updated successfully!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->back()->with('success', 'Experience deleted successfully!');
    }
}
