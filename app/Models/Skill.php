<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Scope to get skills ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('name', 'asc');
    }

    // Scope to get skills by category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
