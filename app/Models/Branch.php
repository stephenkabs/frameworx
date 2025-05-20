<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'address',
        'email',
        'status',
    ];

    public function country()  // Notice it's singular, since a branch belongs to one country
    {
        return $this->belongsTo(Country::class, 'country_id'); // Adjust 'country_id' if it's a different foreign key
    }
}
