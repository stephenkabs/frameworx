<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'website',
        'primary_color',
        'secondary_color',
        'phone',
        'email',
        'image',
        'employee_id',
        'quotation_id',
        'slug',
        'user_id',
    ];

    /**
     * Relationships
     */

    // Relationship with the User model (assuming users own details)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with a Quotation model (if applicable)
     public function quotation()
    {
        return $this->hasMany(Quotation::class);
    }
}
