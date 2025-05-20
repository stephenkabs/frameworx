<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Garnish extends Model
{
    use HasFactory;


        protected $fillable = ['user_id', 'comment', 'document_id', 'amount', 'signature', 'signature_pad', 'slug'];

        protected static function boot()
        {
            parent::boot();

            static::creating(function ($garnish) {
                $garnish->slug = Str::slug($garnish->comment . '-' . uniqid());
            });

            static::updating(function ($garnish) {
                $garnish->slug = Str::slug($garnish->comment . '-' . uniqid());
            });
        }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function clearance()
    {
        return $this->hasMany(Clearance::class);
    }
}
