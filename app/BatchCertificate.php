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

    public function userCertificates()
    {
        return $this->hasMany(BatchCertificateUser::class, 'batch_certificate_id','id');
    }

    
}
