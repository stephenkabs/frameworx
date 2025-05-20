<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expense extends Model
{
    use HasFactory;

    protected $fillable =[
        "user_id",
        "expense_name",
        "expense_type",
        "date_time",
        "attachment",
        "amount",
        "expense_note",
        "attachment_name",
        "image",

    ];

        public function expense()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
