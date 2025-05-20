<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'amount',
        'date',
        'comment',
        'slug',
        'user_id',
    ];

    /**
     * Get the worker associated with the advance.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Get the user who created the advance.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
