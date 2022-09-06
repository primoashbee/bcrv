<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchCertificate extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class,'batch_id','id');
    }
}
