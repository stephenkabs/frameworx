<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['worker_id', 'date', 'present','clock_in','clock_out','user_id'];

    public function workers()
    {
        return $this->belongsTo(Worker::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
