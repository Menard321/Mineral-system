<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsSnapshot extends Model
{
    public $timestamps = false;
    protected $fillable = ['metric_name', 'metric_value', 'region', 'period', 'created_at'];
}
