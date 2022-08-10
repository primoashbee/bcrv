<?php

namespace App\Models\PrimaryModels;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RequeststoStudents extends Model
{
    protected $table = "request_to_students";
    protected $fillable = ['student_id', 'request_from', 'document_name', 
        'date_of_request', 'status'];

    public function user()
    {
        return $this->hasOne(User::class,'id','student_id');
    }
}
