<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuedLicense extends Model
{
    protected $fillable = [
        'license_number', 'company_id', 'license_type', 'issued_by_admin_id', 'issue_date', 'expiry_date', 'status'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function issuer() { return $this->belongsTo(AdminUser::class, 'issued_by_admin_id'); }
}
