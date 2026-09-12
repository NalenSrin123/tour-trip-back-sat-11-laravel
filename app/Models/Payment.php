<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    
    // Explicitly set primary key to match your schema
    protected $primaryKey = 'payments_id'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'booking_id',
        'payment_method',
        'amount',
        'payment_status',
        'transaction_id',
        'paid_at',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'amount'     => 'decimal:2',
        'paid_at'    => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Relationships                               */
    /* -------------------------------------------------------------------------- */

    /**
     * Get the booking that owns the payment.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}