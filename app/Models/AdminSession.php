<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSession extends Model
{
    public $timestamps = false;
    protected $table = 'admin_sessions';

    protected $fillable = [
        'admin_id', 'ip_address', 'device_info', 'login_time', 'logout_time',
    ];

    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_id');
    }
}
