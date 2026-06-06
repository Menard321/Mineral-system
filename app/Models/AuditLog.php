<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'admin_id', 'action_type', 'module', 'entity_type', 'entity_id',
        'old_data', 'new_data', 'ip_address', 'timestamp',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
        'timestamp' => 'datetime',
    ];

    public function admin(): BelongsTo { return $this->belongsTo(AdminUser::class, 'admin_id'); }

    public static function log($action_type, $module, $entity = null, $old = null, $new = null)
    {
        return static::create([
            'admin_id' => auth('admin')->id(), // Assuming 'admin' guard
            'action_type' => $action_type,
            'module' => $module,
            'entity_type' => $entity ? get_class($entity) : null,
            'entity_id' => $entity ? $entity->id : null,
            'old_data' => $old,
            'new_data' => $new,
            'ip_address' => request()->ip(),
            'timestamp' => now(),
        ]);
    }
}
