<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // <--- ត្រូវមានបន្ទាត់នេះ

class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';
    protected $primaryKey = 'destination_id';
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}