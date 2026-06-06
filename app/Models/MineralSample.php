<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MineralSample extends Model
{
    // Status Flow Constants
    const STATUS_REGISTERED = 'REGISTERED'; // Layer 1
    const STATUS_RECEIVED   = 'RECEIVED';   // Layer 2
    const STATUS_TESTING    = 'TESTING';    // Layer 3
    const STATUS_REVIEWED   = 'REVIEWED';   // Layer 3 (Gov Validation)
    const STATUS_CERTIFIED  = 'CERTIFIED';  // Layer 3 (Final)
    const STATUS_REJECTED   = 'REJECTED';

    protected $fillable = [
        'sample_id', 'user_id', 'mineral_type', 'mineral_category', 
        'mining_license_number', 'sample_purpose', 'grade', 'quantity_kg', 
        'estimated_weight', 'collection_site', 'gps_coordinates', 'priority', 
        'status', 'assigned_technician', 'received_at', 'verified_by_admin_id', 
        'physical_condition', 'storage_location', 'notes', 'qr_code', 
        'attachment_path', 'collected_at',
    ];

    protected $casts = [
        'collected_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function certificate(): HasOne { return $this->hasOne(Certificate::class, 'sample_id'); }
    public function labTests() { return $this->hasMany(LabTest::class, 'sample_id'); }
    public function tracking() { return $this->hasMany(SampleTracking::class, 'sample_id'); }
    public function verifier(): BelongsTo { return $this->belongsTo(AdminUser::class, 'verified_by_admin_id'); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 1000;
        return 'GMITE-SMP-' . date('Y') . '-' . str_pad($last + 1, 6, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_CERTIFIED => 'secondary',
            self::STATUS_TESTING, self::STATUS_REVIEWED => 'primary',
            self::STATUS_REJECTED => 'error',
            self::STATUS_REGISTERED => 'info',
            self::STATUS_RECEIVED => 'warning',
            default => 'on-surface-variant',
        };
    }

    public function getProgressAttribute(): int
    {
        return match($this->status) {
            self::STATUS_REGISTERED => 25,
            self::STATUS_RECEIVED   => 50,
            self::STATUS_TESTING    => 75,
            self::STATUS_REVIEWED   => 90,
            self::STATUS_CERTIFIED  => 100,
            self::STATUS_REJECTED   => 0,
            default => 0,
        };
    }
}
