<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;



    protected $fillable = [
        'name', 'description', 'start_time', 'end_time', 'location', 'price', 'available_tickets','date','image','organizer_name',
'number',
'email',
'mobile_money_number',
'mobile_money_name',
'mobile_money_number_two',
'mobile_money_name_two',
    ];




        public function tickets()
        {
            return $this->hasMany(Ticket::class, 'event_id');
        }

        public function ticket()
{
    return $this->hasOne(Ticket::class, 'event_id', 'id');
}

public function purchases()
{
    return $this->hasMany(Purchase::class, 'event_id');
}







}
