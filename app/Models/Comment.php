<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment', 'signature', 'signature_pad','document_id'];

    // Relationship: A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
