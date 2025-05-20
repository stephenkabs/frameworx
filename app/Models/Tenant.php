<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends BaseTenant
{
    public function domains(): HasMany
    {
        return $this->hasMany(\Stancl\Tenancy\Database\Models\Domain::class);
    }
}
