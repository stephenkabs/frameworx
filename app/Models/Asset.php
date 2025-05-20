<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insurance;

class Asset extends Model
{
    use HasFactory;

    protected $fillable =[

"name",
"asset_description",
"supplier_name",
"amount",
"supplier_contact",
"delivery_date",
"warrant_start_date",
"warrant_duration",
"image",

];

public function assets()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}




}
