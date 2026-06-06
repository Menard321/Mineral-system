<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    protected $fillable = [
        'license_id', 'user_id', 'company_id', 'type', 'operating_region',
        'justification', 'status', 'issued_at', 'expires_at', 'approved_by',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function company(): BelongsTo { return $this->belongsTo(Company::class); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 0;
        return 'GMITE-LIC-' . str_pad($last + 1, 5, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'approved', 'renewed' => 'secondary',
            'submitted', 'under_review' => 'primary',
            'expired', 'rejected' => 'error',
            'info_required' => 'warning',
            default => 'on-surface-variant',
        };
    }
}
