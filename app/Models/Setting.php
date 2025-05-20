<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'name',
            'about',
            'version',
            'email',
            'address',
            'phone',
            'copyright',
            'web_color',
            'footer_color',
            'status',
            'image',
            'file',
            'user_id',
    ];


    public function settings()
    {
        return $this->belongsTo(Setting::class);
    }
}
