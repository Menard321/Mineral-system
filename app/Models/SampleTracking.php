<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SampleTracking extends Model
{
    protected $table = 'sample_tracking';
    protected $fillable = [
        'sample_id', 'stage', 'updated_by', 'admin_id', 
        'handler_role', 'notes', 'timestamp'
    ];
    public $timestamps = false;
    public function sample() { return $this->belongsTo(MineralSample::class, 'sample_id'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }
    public function admin() { return $this->belongsTo(AdminUser::class, 'admin_id'); }
}
