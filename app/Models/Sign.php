<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory;
protected $fillable = [

'name',
'type',
'update_id',
'date',
'email',
'number',
'address',
'user_id',
];

public function updates()
{
    return $this->belongsTo(Update::class, 'update_id', 'id');

}

}
