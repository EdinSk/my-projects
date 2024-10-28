<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'bio',
        'title',
        'phone',
        'city',
        'country',
        'cv_url',
        'photo_url',
        'acquired_points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'acquired_points' => 'integer',
    ];

    // Relationships

    public function connections()
    {
        return $this->belongsToMany(User::class, 'user_connections', 'user_id', 'friend_id')
            ->withTimestamps();
    }

    public function recommendationsGiven()
    {
        return $this->hasMany(Recommendation::class, 'from_user_id');
    }

    public function recommendationsReceived()
    {
        return $this->hasMany(Recommendation::class, 'to_user_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('acquired_at')
            ->withTimestamps();
    }

    public function notificationPreferences()
    {
        return $this->hasMany(NotificationPreference::class);
    }

    public function blogComments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function tickets()
    {
        return $this->hasMany(TicketPurchase::class);
    }

    public function likedBlogs()
    {
        return $this->hasMany(BlogLike::class);
    }

    // Helper Methods

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Mutator to automatically hash passwords.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the user's ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function speakingEvents()
    {
        return $this->belongsToMany(Event::class, 'event_speakers', 'speaker_id', 'event_id')
            ->withPivot('order');
    }
}
