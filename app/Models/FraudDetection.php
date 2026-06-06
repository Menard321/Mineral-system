<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FraudDetection extends Model
{
    protected $fillable = [
        'detected_by', 'entity_type', 'entity_id', 'fraud_score', 'description', 'action_taken', 'admin_id'
    ];

    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
    public function entity() { return $this->morphTo(null, 'entity_type', 'entity_id'); }
}
