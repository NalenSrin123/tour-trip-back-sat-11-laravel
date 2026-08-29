<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Custom table name matching the schema
    protected $table = 'destinations_tb';

    // Primary key override
    protected $primaryKey = 'destination_id';

    // Disable updated_at since only created_at is present in the table schema
    const UPDATED_AT = null;

    // Mass-assignable attributes
    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}