<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Document extends Model
{
    use HasFactory;

    protected $fillable =[
'supplier_name',
'tpin',
'invoice_date',
'invoice_no',
'invoice_amount',
'vat_withheld',
'amount_nv',
'description',
'comment',
'currency',
'status',
'slug'



    ];

// Document.php
public function user()
{
    return $this->belongsTo(User::class); // Ensure the relationship is correctly defined
}

public function comments()
{
    return $this->hasMany(Comment::class);
}




    public function assigns()
    {
        return $this->hasMany(Assign::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'assigns')->withTimestamps();
    }

    public function garnishes()
    {
        return $this->hasMany(Garnish::class);
    }


    // public function letter()
    // {
    //     return $this->hasMany(Letter::class); // This will allow you to get documents related to the user
    // }

    // public function clearance()
    // {
    //     return $this->hasMany(Clearance::class); // This will allow you to get documents related to the user
    // }


}

