<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'bio',
        'photo_url',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    // Relationships
    public function events()
    {
        // Define the inverse relationship to events
        return $this->belongsToMany(Event::class, 'event_speaker', 'speaker_id', 'event_id')
                    ->withPivot('speaker_type', 'order');
    }

    public function agendaItems()
    {
        return $this->hasMany(AgendaItem::class);
    }
}
