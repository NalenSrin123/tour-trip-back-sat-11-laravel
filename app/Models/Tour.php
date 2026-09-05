<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $primaryKey = 'tour_id';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'destination_id',
        'title',
        'price',
        'duration',
        'included_services',
        'excluded_services',
        'rating_avg',
        'created_at',
    ];

    /**
     * A tour belongs to a category
     */
    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'category_id', 'category_id');
    }
}