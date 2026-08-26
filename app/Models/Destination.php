<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    // public function tours()
    // {
    //     return $this->hasMany(Tour::class, 'destination_id');
    // }
}