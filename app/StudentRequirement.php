<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRequirement extends Model
{
    protected $guarded = [];
    const PENDING = 1;
    const APPROVED = 2;
    const MISSING = 3;

    public function student()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }

    public function getHTMLAttribute()
    {

    
        if($this->status == self::PENDING){
            return [
                'code'=>422,
                'message'=>'Pending',
                'class'=>'is-invalid',
                'feedback_class'=>'invalid-feedback'
    
            ];
        }
        if($this->status == self::APPROVED){
            return [
                'code'=>200,
                'message'=>'Approved',
                'class'=>'is-valid',
                'feedback_class'=>'valid-feedback'
            ];
        }
        if($this->status == self::MISSING){
            return [
                'code'=>404,
                'message'=>'Missing',
                'class'=>'is-invalid',
                'feedback_class'=>'invalid-feedback'
            ];
        }
    }

}
