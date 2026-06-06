<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemAlert extends Model
{
    // Status constants matching the new admin portal schema
    const STATUS_OPEN        = 'OPEN';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_RESOLVED    = 'RESOLVED';

    public $timestamps = true;

    protected $fillable = [
        'alert_type', 'severity', 'message', 'related_entity_type', 
        'related_entity_id', 'status',
    ];

    // Scope: only open/in-progress alerts
    public function scopeActive($query)
    {
        return $query->where('status', '!=', self::STATUS_RESOLVED);
    }

    public function related()
    {
        return $this->morphTo(null, 'related_entity_type', 'related_entity_id');
    }

    public function getSeverityColorAttribute(): string
    {
        return match(strtolower($this->severity)) {
            'critical' => 'error',
            'warning'  => 'warning',
            default    => 'info',
        };
    }
}
