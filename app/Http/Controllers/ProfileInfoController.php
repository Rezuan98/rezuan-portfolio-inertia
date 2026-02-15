<?php

namespace App\Http\Controllers;

use App\Models\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileInfoController extends Controller
{
    public function index()
    {
        $profile = ProfileInfo::first();

        return Inertia::render('Backend/Profile/Create', [
            'profile' => $profile
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // Simplified validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        // Get existing profile or create new one
        $profile = ProfileInfo::first() ?? new ProfileInfo();

        // Set all fields
        $profile->fill($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($profile->image && Storage::disk('public')->exists($profile->image)) {
                Storage::disk('public')->delete($profile->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $profile->image = $imagePath;
        }

        // Save profile
        $profile->save();

        return redirect()->back()->with('success', 'Profile saved successfully!');
    }
}