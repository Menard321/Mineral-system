<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportClearance extends Model
{
    protected $fillable = [
        'trade_id', 'clearance_number', 'issued_by_admin_id', 'status', 'port_of_exit', 'issue_date'
    ];

    public function trade() { return $this->belongsTo(TradeRequest::class, 'trade_id'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'issued_by_admin_id'); }
}
