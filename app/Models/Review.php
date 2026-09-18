<?php
<<<<<<< HEAD

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $primaryKey = 'reviews_id';
    protected $fillable =['
    tour_id',
    'user_id',
    'rating',
    'comment',
    'status
    '];
=======
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tour;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews_tb';
    protected $primaryKey = 'review_id';

    const UPDATED_AT = null;

    protected $fillable = [
        'tour_id',
        'user_id',
        'rating',
        'comment',

    ];

    protected $casts = [
        'tour_id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'integer',
    ];
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
>>>>>>> 0d816294fca7ef174417130aed17ff92c2d03b78
}
