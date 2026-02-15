<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AboutSectionController extends Controller
{
    public function index()
    {
        $about = AboutSection::first();

        return Inertia::render('Backend/About/Create', [
            'about' => $about
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // Simplified validation
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'years_experience' => 'nullable|integer|min:0',
            'projects_completed' => 'nullable|integer|min:0',
            'happy_clients' => 'nullable|integer|min:0',
            'technologies_count' => 'nullable|integer|min:0',
            'has_server_management' => 'nullable|boolean',
        ]);

        // Get existing about section or create new one
        $about = AboutSection::first() ?? new AboutSection();

        // Set all fields
        $about->fill($validated);

        // Save about section
        $about->save();

        return redirect()->back()->with('success', 'About section saved successfully!');
    }
}
