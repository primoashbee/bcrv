<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchUser extends Model
{
    protected $guarded  = [];
    const COMPLETED = 1;
    const NOT_COMPLETED = 2;
    const BACKED_OUT = 3;
    
    public function batch()
    {
        return $this->belongsTo(Batch::class,'id','batch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
