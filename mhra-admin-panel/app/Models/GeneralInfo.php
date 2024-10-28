<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'hero_image_url',
        'social_links',
        'description',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
