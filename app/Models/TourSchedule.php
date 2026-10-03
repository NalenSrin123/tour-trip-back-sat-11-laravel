<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'tour_id';

    protected $fillable = [
        'guide_id',
        'category_id',
        'destination_id',
        'title',
        'price',
        'duration',
        'included_services',
        'excluded_services',
        'rating_avg',
    ];

    public function guide(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guide_id', 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TourCategory::class, 'category_id', 'category_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'destination_id');
    }
}
