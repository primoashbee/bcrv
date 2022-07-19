<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class StudentsDocumentsModel extends Model
{
    protected $table = "students_documents";
    protected $fillable = ['file_name', 'description', 'path', 'size', 'datetime', 'submitted_by'];
}
