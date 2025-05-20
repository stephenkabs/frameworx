<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_name',
        'link',
        'type',
        'user_id',
        'sub_name'
    ];

    /**
     * Boot the model to handle slug generation automatically.
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($menu) {
    //         if (empty($menu->slug)) {
    //             $menu->slug = static::generateUniqueSlug($menu->menu_name);
    //         }
    //     });

    //     static::updating(function ($menu) {
    //         if ($menu->isDirty('menu_name')) {
    //             $menu->slug = static::generateUniqueSlug($menu->menu_name, $menu->id);
    //         }
    //     });
    // }

    // /**
    //  * Generate a unique slug for the menu.
    //  *
    //  * @param string $menuName
    //  * @param int|null $ignoreId
    //  * @return string
    //  */
    // protected static function generateUniqueSlug($menuName, $ignoreId = null)
    // {
    //     $slug = Str::slug($menuName);
    //     $originalSlug = $slug;
    //     $counter = 1;

    //     while (self::where('slug', $slug)
    //             ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
    //             ->exists()) {
    //         $slug = "{$originalSlug}-{$counter}";
    //         $counter++;
    //     }

    //     return $slug;
    // }

    /**
     * Define the relationship to the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
