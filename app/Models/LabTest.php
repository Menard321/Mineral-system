<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    protected $fillable = ['sample_id', 'test_type', 'method', 'result_summary', 'status', 'technician_id', 'completed_at'];
    public function sample() { return $this->belongsTo(MineralSample::class, 'sample_id'); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
    public function results() { return $this->hasMany(LabResult::class, 'test_id'); }
}
