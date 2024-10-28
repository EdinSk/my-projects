<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'agenda_id',
        'day_number',
        'start_time',
        'end_time',
        'title',
        'description',
        'speaker_id',
        'order',
    ];

    // Relationships
    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
}
