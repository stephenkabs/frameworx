<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'target_type',
        'target',
        'date',
        'venue',
        'about_event',
        'register',
        'status',
        'image',
];

// public function Sign()
// {
//     return $this->hasMany(Sign::class, 'update_id', 'id');

// }

}
