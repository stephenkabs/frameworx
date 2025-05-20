<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waza extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'net_pay',
        'accuedle_days',
        'leave_days_taken',
        'worked_days',
        'term_date',
        'comment',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
