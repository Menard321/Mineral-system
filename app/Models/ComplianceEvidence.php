<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplianceEvidence extends Model
{
    protected $fillable = [
        'compliance_case_id', 'document_type', 'file_path', 'file_hash',
        'uploaded_by', 'description'
    ];

    public function complianceCase(): BelongsTo { return $this->belongsTo(ComplianceCase::class); }
    public function uploader(): BelongsTo { return $this->belongsTo(AdminUser::class, 'uploaded_by'); }

    // Immutability Check: Evidence cannot be updated
    public static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            throw new \Exception("Compliance Evidence is immutable and cannot be modified once documented.");
        });
    }
}
