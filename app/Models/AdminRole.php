<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable = ['role_name', 'description', 'permission_level'];

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->hasMany(AdminUser::class, 'role_id');
    }
}
