<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'notification_target',
        'notification_topic',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
