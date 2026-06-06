<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvestmentOpportunity extends Model
{
    protected $fillable = ['title', 'mineral_type', 'location', 'estimated_value', 'status', 'created_by'];
    public function author() { return $this->belongsTo(User::class, 'created_by'); }
    public function applications() { return $this->hasMany(InvestorApplication::class, 'opportunity_id'); }
}
