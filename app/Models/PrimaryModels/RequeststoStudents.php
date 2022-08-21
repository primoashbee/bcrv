<?php

namespace App\Models\PrimaryModels;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RequeststoStudents extends Model
{
    protected $table = "request_to_students";
    // protected $fillable = ['student_id', 'request_from', 'document_name', 
    //     'date_of_request', 'status'];
    protected $guarded = [];
    public function user()
    {
        return $this->hasOne(User::class,'id','student_id');
    }
    

    public function studentInfo()
    {
        return $this->hasOneThrough(
            StudentInfo::class, 
            User::class, 
            'id', 
            'email', //student_info.email
            'student_id',
            'email', //users.email
        );
    }

    public function notificationData($to_admin = false)
    {
 
        if($to_admin){
            $user = $this->user;
            // if($this->status == 'pending'){
            //     return [
            //         'message' => $user->firstname . ' uploaded a document (' . $this->document_name . ')',
            //         'title' => 'BCRV Request'
            //     ];
            // }
            // if($this->status == 'finished'){
            return [
                'message' => $user->studentInfo->name . ' uploaded a document (' . $this->document_name . ')',
                'title' => 'BCRV Request'
            ];
            // }
        }
        return [
            'message' => 'BCRV needs you to upload a document (' . $this->document_name . ')',
            'title' => 'BCRV Request'
        ];

    }

    public function status()
    {
        if($this->status == 'pending' ){
            return [
                'message' => $this->user->first_name . ' has not yet responded to this request',
                'status' => 'information'
            ];
        }
        return [
            'message' => $this->user->first_name . ' already responded to this request',
            'status' => 'success'

        ];
    }

    public function isViewable()
    {
        return $this->status != 'pending' ? true : false;
    }

    public function unsend()
    {
        $this->update([
            'status'=>'pending',
            'response_status'=>'requested',
            'file_name'=>null,
            'path'=>null
        ]);
        return $this;
    }
}
