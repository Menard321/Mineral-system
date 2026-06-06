<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MineralStatistic extends Model
{
    protected $fillable = [
        'mineral_type', 'production_volume', 'export_volume', 'revenue_estimate', 'region', 'date'
    ];
}
