<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = [
        'company_id', 'violation_type', 'severity', 'description', 
        'penalty_action', 'resolved', 'admin_id'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
