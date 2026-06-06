<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeRequest extends Model
{
    protected $fillable = [
        'trade_id','user_id','certificate_id','mineral_type','quantity_kg',
        'trade_type','buyer_name','buyer_country','value_usd',
        'status','destination_port','rejection_reason',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function certificate(): BelongsTo { return $this->belongsTo(Certificate::class, 'certificate_id'); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 0;
        return 'GMITE-TRD-' . str_pad($last + 1, 5, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'completed', 'export_cleared' => 'secondary',
            'compliance_approved', 'lab_verified' => 'primary',
            'rejected', 'suspended' => 'error',
            default => 'on-surface-variant',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'              => 'PENDING REVIEW',
            'lab_verified'         => 'LAB VERIFIED',
            'compliance_approved'  => 'COMPLIANCE APPROVED',
            'export_cleared'       => 'EXPORT CLEARED',
            'completed'            => 'COMPLETED',
            'rejected'             => 'REJECTED',
            'suspended'            => 'SUSPENDED',
            default                => strtoupper($this->status),
        };
    }
}
