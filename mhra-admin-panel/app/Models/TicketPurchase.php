<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_type_id',
        'price',
        'purchase_date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(EventTicketType::class, 'ticket_type_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
