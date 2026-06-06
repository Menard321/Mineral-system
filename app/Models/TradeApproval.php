<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeApproval extends Model
{
    protected $fillable = [
        'trade_id', 'admin_id', 'status', 'risk_level', 'comments'
    ];

    public function trade() { return $this->belongsTo(TradeRequest::class, 'trade_id'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
