<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MineralSample extends Model
{
    protected $fillable = [
        'sample_id','user_id','mineral_type','grade','quantity_kg',
        'collection_site','gps_coordinates','priority','status',
        'assigned_technician','notes','qr_code','attachment_path','collected_at',
    ];

    protected $casts = ['collected_at' => 'datetime'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function certificate(): HasOne { return $this->hasOne(Certificate::class, 'sample_id'); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 0;
        return 'GMITE-SMP-' . str_pad($last + 1, 5, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'completed', 'certified' => 'secondary',
            'testing', 'reviewed'   => 'primary',
            'rejected'              => 'error',
            default                 => 'on-surface-variant',
        };
    }

    public function getProgressAttribute(): int
    {
        return match($this->status) {
            'received'   => 10, 'registered' => 25, 'assigned' => 40,
            'testing'    => 60, 'reviewed'   => 80, 'completed' => 95,
            'certified'  => 100, 'rejected'  => 0, default => 0,
        };
    }
}
