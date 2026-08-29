<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'booking_number',
        'user_id',
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

    // A booking can have one payment
    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'booking_id');
    }
}