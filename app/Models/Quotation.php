<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
    'status',
        'quotation_note', 'tax_name', 'tax_percentage', 'tax_amount',
        'grand_total', 'slug', 'detail_id', 'user_id','account_id','type','delivery_status','client_id' // Added 'user_id' here
    ];

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    // public function profit()
    // {
    //     return $this->hasMany(Profit::class);
    // }

    public function profit()
{
    return $this->hasOne(Profit::class);
}


    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }

//     public function detail()
// {
//     return $this->hasOne(Quotation::class);
// }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }


        // Relationship with Donation
    // public function donation()
    // {
    //     return $this->belongsTo(Donation::class);
    // }
}
