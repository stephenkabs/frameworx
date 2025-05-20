<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'amount_paid',
        'note',
        'date',
        'amount_spent',
        'user_id',
        'slug',
    ];


    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

}
