<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'description',
        'title',
        'slug',
        'user_id',

    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
