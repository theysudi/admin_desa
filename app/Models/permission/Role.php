<?php

namespace App\Models\permission;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN_PUSAT = 1;

    protected $fillable = [
        'nama',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}