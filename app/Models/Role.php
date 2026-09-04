<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Route model binding
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Automatically generate slug when creating role.
     */
    protected static function booted(): void
    {
        static::creating(function (Role $role) {
            if (empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }

            if ($role->is_active === null) {
                $role->is_active = true;
            }
        });
    }
}