<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BatchCertificateUser extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function certificate()
    {
        return $this->belongsTo(BatchCertificate::class,'batch_certificate_id', 'id');
    }

    public function pivot()
    {
        return DB::table('batch_users')
        ->where('batch_id',$this->certificate->batch->id)
        ->where('user_id', $this->user_id)->first();
    }

    public function getUploadStatusAttribute()
    {
        return !is_null($this->path);
    }


    
}
