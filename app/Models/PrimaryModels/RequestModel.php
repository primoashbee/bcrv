<?php

namespace App\Models\PrimaryModels;

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
}
