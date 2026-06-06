<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    protected $fillable = ['user_id', 'token', 'type', 'expires_at', 'used_at'];
    public function user() { return $this->belongsTo(User::class); }
}
