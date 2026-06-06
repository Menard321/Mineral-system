<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseApplication extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'license_type', 'status', 'submitted_at'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function company() { return $this->belongsTo(Company::class); }
    public function approvals() { return $this->hasMany(LicenseApproval::class); }
}
