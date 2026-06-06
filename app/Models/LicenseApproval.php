<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseApproval extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'license_application_id', 'admin_id', 'decision', 'comments', 'decision_date'
    ];

    public function application() { return $this->belongsTo(LicenseApplication::class, 'license_application_id'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
