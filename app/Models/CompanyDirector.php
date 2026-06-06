<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CompanyDirector extends Model
{
    protected $fillable = ['company_id', 'full_name', 'nationality', 'id_number', 'role'];
    public function company() { return $this->belongsTo(Company::class); }
}
