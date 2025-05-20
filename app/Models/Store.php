<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'stream_name',
        'stream_link',
        'stream_about',
        'status',
        'type',
        'file',
        'user_id'
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function userStatuses()
{
    return $this->hasMany(UserStoreStatus::class);
}

}
