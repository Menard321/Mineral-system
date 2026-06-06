<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    protected $fillable = ['test_id', 'element_name', 'value', 'unit'];
    public function test() { return $this->belongsTo(LabTest::class, 'test_id'); }
}
