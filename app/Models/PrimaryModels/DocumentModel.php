<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentModel extends Model
{
    use SoftDeletes;
    protected $table = "documents";
    // protected $fillable = ['file_name', 'path', 'size', 'datetime'];
    protected $guarded = [];

    public function getSignedNameAttribute()
    {
        return $this->signed ? "Signed" : "Non-signable";
    }
}
