<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ComplianceRecord extends Model
{
    protected $fillable = ['company_id', 'compliance_score', 'status', 'last_audit_date'];
    public function company() { return $this->belongsTo(Company::class); }
}
