<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'reviews_id';

    protected $fillable = [
        'tour_id',
        'user_id',
        'rating',
        'comment',
        'status',
    ];
}