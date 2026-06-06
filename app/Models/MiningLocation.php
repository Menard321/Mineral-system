<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiningLocation extends Model
{
    protected $fillable = [
        'company_id', 'latitude', 'longitude', 'mineral_type', 'site_name'
    ];

    public function company() { return $this->belongsTo(Company::class); }
}
