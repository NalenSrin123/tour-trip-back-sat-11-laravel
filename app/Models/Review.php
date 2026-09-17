<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // កំណត់ឈ្មោះ Table ឱ្យត្រូវ
    protected $table = 'reviews';

    // **ចំណុចសំខាន់៖** ប្រាប់ Laravel ឱ្យដឹងថា Primary Key មិនមែន id ទេ គឺ reviews_id
    protected $primaryKey = 'reviews_id';

    public $timestamps = false; // ឬ true ទៅតាម table របស់អ្នក

    protected $fillable = ['tour_id', 'user_id', 'rating', 'comment', 'status'];
}