<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_id',
        'detail_id',
        'prepared_by',
        'report_days',
        'advance_reports',
        'date',
        'user_id',
        'slug',
    ];


    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }

    public function worker()
    {
        return $this->hasOneThrough(Worker::class, Salary::class, 'id', 'id', 'salary_id', 'worker_id');
    }
}
