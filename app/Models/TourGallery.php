<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGallery extends Model
{
    use HasFactory;

    protected $table = 'tour_galleries';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    const UPDATED_AT = null;

    protected $fillable = [
        'tour_id',
        'image_url',
    ];

   
    // public function tour()
    // {
    //     return $this->belongsTo(Tour::class, 'tour_id');
    // }
}