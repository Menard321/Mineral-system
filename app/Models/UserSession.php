<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $fillable = ['user_id', 'device_info', 'ip_address', 'login_time', 'logout_time'];
    public function user() { return $this->belongsTo(User::class); }
}
