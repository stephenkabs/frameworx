<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'pricing_id',
        'status',
        'password',
        'wallpaper',
        'lock_password',
        'city',
        'image',
        'trial_start',
        'trial_end',
        'special_code', // Add this field
        'country_id',
        'is_paid',
        'slug', // Add slug here
        'last_activity',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_activity' => 'datetime',
        'trial_end' => 'datetime',
        'trial_start' => 'datetime',
    ];

    /**
     * Automatically set the slug and special code when creating a user.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $baseSlug = Str::slug($user->name);
            $slug = $baseSlug;
            $count = 1;

            // Ensure slug is unique
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $user->slug = $slug;
            $user->special_code = 'ZRA' . strtoupper(Str::random(6));
        });
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'assigns')->withTimestamps();
    }

    public function assigns()
    {
        return $this->hasMany(Assign::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function isTrialExpired(): bool
    {
        return $this->trial_end && $this->trial_end->isPast();
    }

    public function storeStatuses()
{
    return $this->hasMany(UserStoreStatus::class);
}

public function detail()
{
    return $this->hasOne(Detail::class); // NOT hasMany
}


public function setting()
{
    return $this->hasOne(Setting::class); // NOT hasMany
}

public function pricingPlan() { return $this->belongsTo(PricingPlan::class, 'pricing_id', 'id'); }


}
