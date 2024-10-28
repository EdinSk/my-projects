<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'ticket_name',
        'price',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
