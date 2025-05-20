<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Clearance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_name',
        'bank_address',
        'director',
        'prepared_by',
        'position',
        'slug',
        'user_id',
        'garnish_id',
    ];

    /**
     * Boot method to automatically generate slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($clearance) {
            $clearance->slug = Str::slug($clearance->bank_name . '-' . Str::random(6));
        });
    }

    /**
     * Get the user associated with the clearance.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the garnish associated with the clearance.
     */
    public function garnish()
    {
        return $this->belongsTo(Garnish::class);
    }
}
