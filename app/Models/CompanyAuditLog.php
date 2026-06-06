<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAuditLog extends Model
{
    public $timestamps = false;
    protected $table = 'company_audit_logs';

    protected $fillable = [
        'company_id', 'action', 'old_status', 'new_status', 'admin_id', 'timestamp'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
