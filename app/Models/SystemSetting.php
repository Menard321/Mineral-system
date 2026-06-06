<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['setting_key', 'setting_value', 'updated_by_admin_id'];

    public function updater() { return $this->belongsTo(AdminUser::class, 'updated_by_admin_id'); }
}
