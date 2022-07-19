<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    protected $table = "response_table";
    protected $fillable = ['student_id', 'request_id', 'file_name', 'path', 
        'request_date', 'release_date', 'processing_officer', 
        'status', 'date_sent'];
}
