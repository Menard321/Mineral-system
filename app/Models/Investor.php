<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = ['user_id', 'investor_type', 'capital_range', 'investment_focus', 'region_interest'];
    public function user() { return $this->belongsTo(User::class); }
    public function applications() { return $this->hasMany(InvestorApplication::class); }
}
