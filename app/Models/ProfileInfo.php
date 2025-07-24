<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full URL for the profile image
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Return storage URL for local files
        return Storage::url($this->image);
    }

    /**
     * Get profile image with fallback
     *
     * @return string
     */
    public function getImageWithFallbackAttribute()
    {
        return $this->image_url ?? asset('images/default-avatar.png');
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Delete associated image when profile is deleted
        static::deleting(function ($profile) {
            if ($profile->image && Storage::exists($profile->image)) {
                Storage::delete($profile->image);
            }
        });
    }

    /**
     * Scope to get the primary profile (since we only have one)
     */
    public function scopePrimary($query)
    {
        return $query->first();
    }
}