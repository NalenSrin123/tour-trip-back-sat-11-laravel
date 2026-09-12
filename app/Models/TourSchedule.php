<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    // Override the default primary key since it's 'user_id' in the diagram
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'status',
        'Profile_img',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relationship: A Guide (User) can have many Tour Schedules
     */
    public function tourSchedules(): HasMany
    {
        return $this->hasMany(TourSchedule::class, 'guide_id', 'user_id');
    }
}