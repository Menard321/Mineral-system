<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Certificate extends Model
{
    protected $fillable = [
        'cert_id', 'document_id', 'user_id', 'sample_id', 'lab_result_approval_id',
        'mineral_type', 'grade', 'quantity_kg', 'issued_by', 'status', 
    ];
    
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function sample(): BelongsTo { return $this->belongsTo(MineralSample::class, 'sample_id'); }
    public function labApproval(): BelongsTo { return $this->belongsTo(LabResultsApproval::class, 'lab_result_approval_id'); }
    public function trades(): HasMany { return $this->hasMany(TradeRequest::class, 'certificate_id'); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 1000;
        return 'GMITE-CERT-' . date('Y') . '-' . str_pad($last + 1, 6, '0', STR_PAD_LEFT);
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
