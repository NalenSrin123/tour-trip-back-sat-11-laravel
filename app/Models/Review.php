<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    // បញ្ជាក់ឈ្មោះ Table ឱ្យចំ (ករណី Table ក្នុង DB ឈ្មោះ 'reviews')
    protected $table = 'reviews';

    // កំណត់ Primary Key តាមដ្យាក្រាម
    protected $primaryKey = 'reviews_id';

    // ប្រាប់ Laravel ថា Primary Key ជាប្រភេទ Auto-incrementing Integer
    public $incrementing = true;
    protected $keyType = 'int';

    // អនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យតាមរយៈ Mass Assignment
    protected $fillable = [
        'tour_id',
        'user_id',
        'rating',
        'comment',
        'status',
    ];

    /**
     * Relationship: Review នីមួយៗជារបស់ User ម្នាក់
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Relationship: Review នីមួយៗជារបស់ TourSchedule មួយ
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(TourSchedule::class, 'tour_id', 'tour_id');
    }
}