<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [

        'account_name',
        'account_number',
        'branch',
        'type',
        'target',
        'user_id',
        'account_id',
        'name',
        'swift_code',
        'sort_code',
        'currency',
    ];



    // Relationship with Donation
    // public function donation()
    // {
    //     return $this->belongsTo(Donation::class);
    // }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

