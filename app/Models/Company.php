<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'name', 'category', 'reg_number', 'tin', 'address',
        'region', 'country', 'phone', 'email', 'website', 'status',
        'incorporation_doc', 'tax_cert_doc', 'business_license_doc', 'notes',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function licenses(): HasMany { return $this->hasMany(License::class); }
    public function directors(): HasMany { return $this->hasMany(CompanyDirector::class); }
    public function documents() { return $this->morphMany(Document::class, 'owner'); }
    public function complianceRecord() { return $this->hasOne(ComplianceRecord::class); }
    public function violations(): HasMany { return $this->hasMany(Violation::class); }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'verified' => 'secondary',
            'under_review' => 'primary',
            'rejected', 'suspended' => 'error',
            default => 'on-surface-variant',
        };
    }
}
