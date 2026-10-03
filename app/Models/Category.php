<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // កំណត់ឈ្មោះ Table ក្នុង Database
    protected $table = 'categories';

    // កំណត់ Field ដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យ (Mass Assignment)
    protected $fillable = [
        'name',
        'description',
    ];
}
