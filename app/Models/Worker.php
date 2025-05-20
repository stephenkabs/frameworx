<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{

    protected $fillable = [
        'name',
        'nrc',
        'nhima_no',
        'napsa_no',
        'napsa_no',
        'mm_number',
        'mm_name',
        'email',
        'phone',
        'designation',
        'department_id', // Updated to use foreign key reference
        'branch_id',     // Added branch reference
        'address',
        'password',
        'occupation',
        'birthday',
        'join_date',
        'gender',
        'bank_name',
        'account_name',
        'bank_code',
        'user_id',
        'branch_location',
        'account_number',
        'bank_identifier_code',
        'tax_id',
        'image', // Field for storing profile image path
        'file',      // Field for storing document file path
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Count days attended
public function attendanceDaysCount()
{
    return $this->attendances()->whereNotNull('clock_in')->count();
}
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    /**
     * Relationships
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }



    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }


    public function salaries()
{
    return $this->hasMany(Salary::class);
}

public function salary()
{
    return $this->hasOne(Salary::class);
}


public function leaves()
{
    return $this->hasMany(Leave::class);
}

public function advance()
{
    return $this->hasMany(Advance::class);
}


}
