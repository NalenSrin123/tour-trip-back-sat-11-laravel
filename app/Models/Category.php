<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // កំណត់ឈ្មោះ Table ក្នុង Database
    protected $table = 'categories';

    // កំណត់ Primary Key ព្រោះមិនមែនជា 'id' លំនាំដើម
    protected $primaryKey = 'category_id';

    // បញ្ជាក់ថា Primary Key ជាប្រភេទ Auto-incrementing Integer
    public $incrementing = true;
    protected $keyType = 'int';

    // កំណត់ Field ដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យ (Mass Assignment)
    protected $fillable = [
        'category_name',
        'description',
    ];
}