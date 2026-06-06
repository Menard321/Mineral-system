<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyApproval extends Model
{
    protected $fillable = [
        'company_id', 'reviewed_by_admin_id', 'status', 'remarks', 'reviewed_at'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'reviewed_by_admin_id'); }
}
