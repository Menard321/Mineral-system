<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JointVenture extends Model
{
    protected $fillable = [
        'jv_id', 'user_id', 'venture_name', 'partner_name',
        'own_equity_pct', 'partner_equity_pct', 'objective', 'status',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }

    public static function generateId(): string
    {
        $last = static::max('id') ?? 0;
        return 'GMITE-JV-' . str_pad($last + 1, 5, '0', STR_PAD_LEFT);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'approved', 'registered' => 'secondary',
            'proposal_submitted', 'partner_review', 'gov_verification' => 'primary',
            'legal_assessment' => 'warning',
            default => 'on-surface-variant',
        };
    }
}
