<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'features',
        'technologies',
        'live_demo_url',
        'github_url',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Scope to get projects ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    // Get features as array
    public function getFeaturesArrayAttribute()
    {
        return $this->features ? explode(',', $this->features) : [];
    }

    // Get technologies as array
    public function getTechnologiesArrayAttribute()
    {
        return $this->technologies ? explode(',', $this->technologies) : [];
    }
}
