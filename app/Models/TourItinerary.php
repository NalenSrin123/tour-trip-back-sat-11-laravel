<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tour;

class TourItinerary extends Model
{
    use HasFactory;

    protected $table = 'tour_itineraries_tb';
    protected $primaryKey = 'tour_itineraries_id';

    const UPDATED_AT = null;

    protected $fillable = [
        'tour_id',
        'day_number',
        'title',
        'description',
    ];

    protected $casts = [
        'tour_id' => 'integer',
        'day_number' => 'integer',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
