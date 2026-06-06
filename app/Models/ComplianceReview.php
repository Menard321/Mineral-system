<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceReview extends Model
{
    protected $fillable = [
        'company_id', 'admin_id', 'compliance_score', 'status', 'remarks'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
