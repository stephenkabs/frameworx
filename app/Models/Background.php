<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Background extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'image',
        'user_id',
    ];

    /**
     * Get the user that owns the background.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
