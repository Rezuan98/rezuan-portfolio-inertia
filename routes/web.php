<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileInfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutSectionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use Inertia\Inertia;
use App\Models\ProfileInfo;

// Frontend Routes - Pass profile data to Home page
Route::get('/', function () {
    $profile = ProfileInfo::first();
    $about = App\Models\AboutSection::first();
    $skills = App\Models\Skill::ordered()->get()->groupBy('category');
    $experiences = App\Models\Experience::ordered()->get();
    $projects = App\Models\Project::ordered()->get();
    $blogs = App\Models\Blog::published()->ordered()->take(6)->get();

    return Inertia::render('Home', [
        'profile' => $profile ? [
            'id' => $profile->id,
            'name' => $profile->name,
            'title' => $profile->title,
            'bio' => $profile->bio,
            'email' => $profile->email,
            'phone' => $profile->phone,
            'location' => $profile->location,
            'github' => $profile->github,
            'linkedin' => $profile->linkedin,
            'twitter' => $profile->twitter,
            'website' => $profile->website,
            'image' => $profile->image,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ] : null,
        'about' => $about,
        'skills' => $skills,
        'experiences' => $experiences,
        'projects' => $projects,
        'blogs' => $blogs
    ]);
})->name('home');

// Blog Routes (Frontend)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Profile Management
    Route::get('/profile/index', [ProfileInfoController::class, 'index'])->name('profile.index');
    Route::post('/profile/store', [ProfileInfoController::class, 'storeOrUpdate'])->name('profile.store');

    // About Section Management
    Route::get('/about/index', [AboutSectionController::class, 'index'])->name('about.index');
    Route::post('/about/store', [AboutSectionController::class, 'storeOrUpdate'])->name('about.store');

    // Skills Management
    Route::get('/skills/index', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills/store', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    // Experience Management
    Route::get('/experiences/index', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::post('/experiences/store', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    // Project Management
    Route::get('/projects/index', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Blog Management
    Route::get('/blogs/index', [BlogController::class, 'manage'])->name('blogs.manage');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});
