<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvestorApplication extends Model
{
    protected $fillable = ['investor_id', 'opportunity_id', 'status'];
    public function investor() { return $this->belongsTo(Investor::class); }
    public function opportunity() { return $this->belongsTo(InvestmentOpportunity::class, 'opportunity_id'); }
}
