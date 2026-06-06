<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ComplianceCase extends Model
{
    protected $fillable = [
        'case_id', 'company_id', 'assigned_officer_id', 'status',
        'risk_level', 'risk_score', 'summary', 'opened_at', 'closed_at'
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public static function generateId(): string
    {
        return 'GMITE-CASE-' . strtoupper(Str::random(8));
    }

    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function officer(): BelongsTo { return $this->belongsTo(AdminUser::class, 'assigned_officer_id'); }
    public function violations(): HasMany { return $this->hasMany(Violation::class); }
    public function evidence(): HasMany { return $this->hasMany(ComplianceEvidence::class); }

    public function getRiskColorAttribute(): string
    {
        return match($this->risk_level) {
            'LOW' => 'secondary',
            'MEDIUM' => 'primary',
            'HIGH' => 'error',
            'CRITICAL' => 'error animate-pulse',
            default => 'on-surface-variant',
        };
    }
}
