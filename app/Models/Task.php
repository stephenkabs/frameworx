<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'start_date',
        'end_date',
        'employee_id',
        'category_id',
        'quotation_id',
        'client_id',
        'status',
        'slug',
    ];

    /**
     * Define the relationship with the User model.
     * A task belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Employee model.
     * A task may optionally belong to an employee.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Define the relationship with the Category model.
     * A task may optionally belong to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }


}
