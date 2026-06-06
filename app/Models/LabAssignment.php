<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabAssignment extends Model
{
    protected $fillable = [
        'sample_id', 'lab_id', 'assigned_by_admin_id', 'status'
    ];

    public function sample() { return $this->belongsTo(MineralSample::class, 'sample_id'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'assigned_by_admin_id'); }
}
