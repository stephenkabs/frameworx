<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [

        'sub_title',
        'title',
        'content',
        'cs',
        'cs_figure',
        'pc',
        'pc_figure',
        'status',
        'user_id',
        'image',
        'file',
    ];
}
