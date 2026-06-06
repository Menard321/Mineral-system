<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin_users';

    protected $fillable = [
        'full_name',
        'email',
        'password_hash',
        'phone',
        'role_id',
        'department_id',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }

    public function sessions()
    {
        return $this->hasMany(AdminSession::class, 'admin_id');
    }
}
