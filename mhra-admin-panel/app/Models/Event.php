<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define constants for the event types
    const TYPE_HR_COFFEE = 'HR_Coffee';
    const TYPE_HR_WEEKEND = 'HR_Weekend';
    const TYPE_HR_WEBINAR = 'HR_Webinar';
    const TYPE_HR_CONFERENCE = 'HR_Conference';

    protected $fillable = [
        'title',
        'theme',
        'description',
        'objective',
        'location',
        'start_date',
        'end_date',
        'is_conference',
        'status',
        'hero_image_url',
        'organizable_id',  // Ensure these fields are fillable
        'organizable_type', // for the polymorphic relationship
        'event_type',
    ];

    // Relationships
    public function ticketTypes()
    {
        return $this->hasMany(EventTicketType::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speakers', 'event_id', 'speaker_id')
            ->withPivot('order') // Assuming 'order' is stored in the pivot table
            ->orderBy('pivot_order'); // Order speakers by the specified order
    }

    // One-to-One relationship with Agenda
    public function agenda()
    {
        return $this->hasOne(Agenda::class);
    }

    // One-to-Many relationship with AgendaItem (assuming each agenda has multiple items)
    public function agendaItems()
    {
        return $this->hasManyThrough(AgendaItem::class, Agenda::class);
    }

    public function ticketPurchases()
    {
        return $this->hasMany(TicketPurchase::class);
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeHrCoffee($query)
    {
        return $query->where('event_type', self::TYPE_HR_COFFEE);
    }

    public function scopeHrWeekend($query)
    {
        return $query->where('event_type', self::TYPE_HR_WEEKEND);
    }

    public function scopeHrWebinar($query)
    {
        return $query->where('event_type', self::TYPE_HR_WEBINAR);
    }

    public function scopeHrConference($query)
    {
        return $query->where('event_type', self::TYPE_HR_CONFERENCE);
    }

    // Polymorphic relationship for organizers (either User or Company)
    public function organizerable()
    {
        return $this->morphTo();
    }
}
