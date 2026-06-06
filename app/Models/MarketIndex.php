<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketIndex extends Model
{
    protected $fillable = [
        'mineral_type', 'price_per_kg', 'currency', 'unit', 'last_updated_at'
    ];
}
