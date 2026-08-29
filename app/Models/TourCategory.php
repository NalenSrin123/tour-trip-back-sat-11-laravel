<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    use HasFactory;

    protected $table = 'tour_categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name',
        'description',
        'created_at',
    ];

    /**
     * A category has many tours
     */
    public function tours()
    {
        return $this->hasMany(Tour::class, 'category_id', 'category_id');
    }
}