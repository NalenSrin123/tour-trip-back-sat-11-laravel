<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';
    protected $primaryKey = 'destination_id';
    
    // បិទ updated_at ព្រោះ table គ្មាន column នេះទេ
    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}