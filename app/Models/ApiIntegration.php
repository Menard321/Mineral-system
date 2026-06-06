<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiIntegration extends Model
{
    protected $fillable = ['service_name', 'api_key_encrypted', 'status', 'last_sync_at'];

    protected $casts = [
        'last_sync_at' => 'datetime',
    ];
}
