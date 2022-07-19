<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = "requests";
    protected $fillable = ['student_id', 'course', 'document_name', 
        'number_of_copies', 'date_of_request', 'release_date', 
        'processing_officer', 'status'];
}
