<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    protected $table = "students";
    protected $fillable = ['complete_name', 'course', 'year', 'contact_number', 'email'];
}
