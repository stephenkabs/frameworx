<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'button_name',
        'button_link',
        'about',
        'status',
        'user_id',
    ];
}
