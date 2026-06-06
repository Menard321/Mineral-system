<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueReport extends Model
{
    protected $fillable = [
        'trade_request_id', 'real_market_value', 'declared_value', 
        'valuation_gap', 'royalty_amount', 'processing_fee', 
        'export_tax', 'risk_score', 'risk_level', 'analysis_metadata'
    ];

    protected $casts = [
        'analysis_metadata' => 'json'
    ];

    public function tradeRequest(): BelongsTo
    {
        return $this->belongsTo(TradeRequest::class);
    }
}
