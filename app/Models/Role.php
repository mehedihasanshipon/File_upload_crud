<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function createPermission($request)
    {
        $this->permissions()->sync($request->permission);
    }

    public function hasPermission($permission)
    {
        if ($this->permissions->where('slug', $permission)->first()) {
            return true;
        }
    }
}
