<?php

namespace App\Models\PrimaryModels;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestModel extends Model
{
    use SoftDeletes;
    protected $table = "requests";
    // protected $fillable = ['student_id', 'course', 'document_name', 
    //     'number_of_copies', 'date_of_request', 'release_date', 
    //     'processing_officer', 'status'];
    protected $guarded = [];

    public function document()
    {
        return $this->hasOne(DocumentModel::class, 'id', 'document_name');
    }

    public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class,'alternate_id','student_id');
    }

    public function notificationData($to_admin = false)
    {
        // if(!$to_admin){
        //     if($this->status == self::APPROVED){
        //         return [
        //             'message'=>'Your submitted requirement is approved!',
        //             'title'  => 'Requirement: ' . $this->requirement->name
        //         ];
        //     }
        //     if($this->status == self::REJECTED){
        //         return [
        //             'message'=>'Your submitted requirement is Rejected!',
        //             'title'  => 'Requirement: ' . $this->requirement->name
        //         ];
        //     }
        //     if($this->status == self::PENDING){
        //         return [
        //             'message'=>'Your submitted requirement is Pending!',
        //             'title'  => 'Requirement: ' . $this->requirement->name
        //         ];
        //     }
        // }

        if($to_admin){
            return [
                'message'=> $this->studentInfo->name . ' request a document (' . $this->document->filename . ')',
                'title'=> 'Document Request'
            ];
        }

        return [
            'message' => 'BCRV has responded to your request (' . $this->document->filename . ')',
            'title'=> 'Document Request'
        ];
    }


    public function isUnSendable(){

    }

    public function unsend()
    {
        $this->update([
            'status'=>'Pending',
            'is_responded'=> false,
        ]);

        return $this;
    }

    public function requestDateFormat()
    {
        return Carbon::parse($this->date_of_request)->format('D, M-d-Y h:i A');
    }
    public function getReleaseDateAttribute()
    {
        return Carbon::parse($this->release_date)->format('D, M-d-Y h:i A');
    }
}
