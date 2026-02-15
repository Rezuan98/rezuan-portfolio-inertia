<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'years_experience',
        'projects_completed',
        'happy_clients',
        'technologies_count',
        'has_server_management',
    ];

    protected $casts = [
        'years_experience' => 'integer',
        'projects_completed' => 'integer',
        'happy_clients' => 'integer',
        'technologies_count' => 'integer',
        'has_server_management' => 'boolean',
    ];
}
