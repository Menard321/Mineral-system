<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = ['permission_name', 'module'];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
