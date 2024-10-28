<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'title',
        'description',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function agendaItems()
    {
        return $this->hasMany(AgendaItem::class);
    }
    public function items()
    {
        return $this->hasMany(AgendaItem::class);
    }
}
