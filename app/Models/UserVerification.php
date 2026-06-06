<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $fillable = [
        'user_id', 'verified_by_admin_id', 'status', 'notes', 'reviewed_at'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'verified_by_admin_id'); }
}
