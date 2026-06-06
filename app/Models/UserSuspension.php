<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSuspension extends Model
{
    protected $fillable = [
        'user_id', 'reason', 'suspended_by', 'start_date', 'end_date', 'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'suspended_by'); }
}
