<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'booking_number',
        'user_id',
        'tour_id',
        'schedule_id',
        'adult_count',
        'child_count',
        'total_price',
        'contact_name',
        'contact_phone',
        'special_request',
        'booking_status',
        'cancel_reason',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'adult_count' => 'integer',
        'child_count' => 'integer',
        'total_price' => 'decimal:2',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Relationships                               */
    /* -------------------------------------------------------------------------- */

    /**
     * Get all payments associated with this booking.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id', 'booking_id');
    }

    /**
     * Get the user who made the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the tour associated with the booking.
     */
    // public function tour(): BelongsTo
    // {
    //     return $this->belongsTo(Tour::class, 'tour_id');
    // }

    /**
     * Get the schedule associated with the booking.
     */
    // public function schedule(): BelongsTo
    // {
    //     return $this->belongsTo(Schedule::class, 'schedule_id');
    // }
}