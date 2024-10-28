<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'content',
    ];

    // Relationships
    public function giver()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function recommendationsReceived()
    {
        return $this->hasMany(Recommendation::class, 'to_user_id');
    }
}
