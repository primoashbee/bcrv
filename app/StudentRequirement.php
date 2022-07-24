<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StudentRequirement extends Model
{
    protected $guarded = [];
    const PENDING = 1;
    const APPROVED = 2;
    const MISSING = 3;
    const REJECTED = 4;

    const STATUS_RULES = [self::PENDING, self::APPROVED, self::MISSING, self::REJECTED];
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
        if($this->status == self::REJECTED){
            return [
                'code'=>404,
                'message'=>'Rejected',
                'class'=>'is-invalid',
                'feedback_class'=>'invalid-feedback'
            ];
        }
    }

    public function getDirectoryAttribute()
    {
        $path = $this->path;
        $filename = $this->filename;
        return Storage::disk('requirements')->path("$path\\$filename");
    }

    public function notificationData($to_admin = false)
    {
        if(!$to_admin){
            if($this->status == self::APPROVED){
                return [
                    'message'=>'Your submitted requirement is approved!',
                    'title'  => 'Requirement: ' . $this->requirement->name
                ];
            }
            if($this->status == self::REJECTED){
                return [
                    'message'=>'Your submitted requirement is Rejected!',
                    'title'  => 'Requirement: ' . $this->requirement->name
                ];
            }
            if($this->status == self::PENDING){
                return [
                    'message'=>'Your submitted requirement is Pending!',
                    'title'  => 'Requirement: ' . $this->requirement->name
                ];
            }
        }

        return [
            'message' => $this->student->first_name . ' uploaded a requirement - ' . $this->requirement->name  . ' ( '. $this->filename.' )',
            'title' => 'Requirement Upload'
        ];

    }

}
