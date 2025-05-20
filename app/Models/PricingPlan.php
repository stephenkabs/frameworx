<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name','currency','button_name','button_link', 'price', 'billing_cycle'];

    public function features()
    {
        return $this->hasMany(PlanFeature::class, 'plan_id');
    }
}
