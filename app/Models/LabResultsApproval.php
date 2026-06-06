<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabResultsApproval extends Model
{
    protected $table = 'lab_results_approval';
    protected $fillable = [
        'lab_test_id', 'admin_id', 'status', 'comments', 'approved_at'
    ];

    public function test() { return $this->belongsTo(LabTest::class, 'lab_test_id'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
