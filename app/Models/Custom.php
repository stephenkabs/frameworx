<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'type',
        'description',
        'user_id',

    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
