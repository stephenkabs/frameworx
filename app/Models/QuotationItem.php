<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = ['quotation_id', 'product_name', 'quantity', 'price', 'total'];

    public function quotation()
{
    return $this->belongsTo(Quotation::class);
}

}
