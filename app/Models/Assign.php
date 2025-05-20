<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Assign extends Model
{
    protected $fillable = ['document_id', 'note', 'type','user_id'];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'assign_user')->withPivot('note');
    // }

    // public function documents()
    // {
    //     return $this->belongsTo(Document::class, 'document_id');
    // }

//     public function users()
// {
//     return $this->belongsToMany(User::class, 'assign_user')->withPivot('note');
// }

public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Assign belongs to one user
}

public function document()
{
    return $this->belongsTo(Document::class, 'document_id'); // Assign belongs to one document
}

// public function documents()
// {
//     return $this->hasMany(Document::class);
// }

// public function user(): BelongsTo
// {
//     return $this->belongsTo(User::class);
// }

// // Relationship with Documents (Many-to-Many)
// public function documents(): BelongsToMany
// {
//     return $this->belongsToMany(Document::class, 'assigns')->withTimestamps();
// }
}
