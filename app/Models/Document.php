<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['owner_type', 'owner_id', 'document_type', 'file_path', 'uploaded_at'];
    public function owner() { return $this->morphTo(); }
}
