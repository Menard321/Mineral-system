<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportRoute extends Model
{
    protected $fillable = [
        'trade_id', 'origin_location', 'destination_country', 'transport_mode', 'status'
    ];

    public function trade() { return $this->belongsTo(TradeRequest::class, 'trade_id'); }
}
