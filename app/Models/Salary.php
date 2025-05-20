<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;


    protected $fillable = [
        'worker_id',
        'basic_salary',
        'housing_allowance',
        'transport_allowance',
        'other_allowance',
        'other_allowance_two',
        'payee',
        'napsa',
        'nhima',
        'daily_hourly',
        'monthly_working_days',
        'net_pay',
        'user_id',
        'daily_earnings',
        'slug',  // Slug for the resource
    ];


    // Relationship to Employee (assuming you have an Employee model)
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    // Relationship to User (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function payslip()
    {
        return $this->hasMany(Payslip::class);
    }

}
