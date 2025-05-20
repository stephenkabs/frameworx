<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Employee extends Model
{
    use HasFactory;


    protected $fillable =[
        "user_id",
        'department_id',
        'name',
        'position',
        'position',
        'address',
        'email',
        'qualification',
        'next_of_kin',
        'phone_number_next_of_kin',
        "phone_number",
        "date_of_birth",
        "country_id",
        "employee_number",
        "health_insurance_no",
        "pension_no",
        "kin_number",
        "amount",
        "image",
        "status",
        "file",
        "gender",
"marital_status",
"position",
"bank_name",
"account_name",
"account_no",

    ];

    public function employee()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');

    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    // public function advance()
    // {
    //     return $this->hasMany(Employee::class, 'employee_id', 'id');

    // }

    // public function salary()
    // {
    //     return $this->hasMany(Salary::class, 'employee_id', 'id');

    // }
}
