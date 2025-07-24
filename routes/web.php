<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileInfoController;
use Inertia\Inertia;
use App\Models\ProfileInfo;

// Frontend Routes - Pass profile data to Home page
Route::get('/', function () {
    $profile = ProfileInfo::first();
    
    return Inertia::render('Home', [
        'profile' => $profile ? [
            'id' => $profile->id,
            'name' => $profile->name,
            'image' => $profile->image,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ] : null
    ]);
})->name('home');

Route::get('/profile/index', [ProfileInfoController::class, 'index'])->name('profile.index');
Route::post('/profile/store', [ProfileInfoController::class, 'storeOrUpdate'])->name('profile.store');



